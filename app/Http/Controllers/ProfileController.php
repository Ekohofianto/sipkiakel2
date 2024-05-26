<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'id_user' => 'required|string|max:255' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048', // max 2MB
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->id_user = $request->input('id_user');

        // Default $path menjadi null
        $path = null;

        // Periksa apakah ada file avatar yang diunggah
        if ($request->hasFile('avatar')) {
            // Ambil file avatar yang diunggah
            $avatar = $request->file('avatar');
            // Simpan gambar di storage
            $path = $avatar->store('avatars', 'public');
            // Periksa apakah pengguna sudah memiliki avatar sebelumnya
            if (Auth::user()->avatar) {
                // Jika ada, hapus avatar lama dari penyimpanan
                Storage::disk('public')->delete(Auth::user()->avatar);
            }
        }

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = $request->input('new_password');
            } else {
                return redirect()->back()->withInput();
            }
        }

        // Update path avatar pengguna dalam model pengguna
        Auth::user()->avatar = $path;
        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }
}
