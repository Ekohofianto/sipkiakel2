@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-4 text-center">
                <div class="card-profile-image mt-4 text-center mb-1">
                    <label for="avatar" style="cursor: pointer;">
                        <figure class="rounded-circle avatar font-weight-bold"
                            style="font-size: 60px; height: 180px; width: 180px;"
                            data-initial="{{ Auth::user()->name[0] }}">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profile Picture"
                                    class="rounded-circle">
                            @endif
                        </figure>
                        <input type="file" id="avatar" class="form-control-file" name="avatar"
                            style="display: none;">
                    </label>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ Auth::user()->fullName }}</h5>
                                <p>Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Informasi User</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama Depan<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name"
                                            placeholder="Nama Depan" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Nama Belakang</label>
                                        <input type="text" id="last_name" class="form-control" name="last_name"
                                            placeholder="Nama Belakang"
                                            value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="id_user">ID User<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="id_user" class="form-control" name="id_user"
                                            placeholder="contoh123" value="{{ old('id_user', Auth::user()->id_user) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Kata Sandi Saat Ini</label>
                                        <input type="password" id="current_password" class="form-control" name="Password "
                                            placeholder="Password Saat Ini">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">Kata Sandi Baru</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password"
                                            placeholder="Kata Sandi Baru">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Konfirmasi
                                            Kata Sandi</label>
                                        <input type="password" id="confirm_password" class="form-control"
                                            name="Konfirmasi Password" placeholder="Konfirmasi Kata Sandi">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('avatar').addEventListener('click', function(event) {
                event.preventDefault();
            });
        });
    </script>
@endsection
