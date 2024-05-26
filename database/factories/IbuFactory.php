<?php

namespace Database\Factories;

use App\Models\Ibu;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class IbuFactory extends Factory
{
    protected $model = Ibu::class;

    public function definition()
    {
        $faker = Faker::create('id_ID'); // Atur lokal Indonesia untuk format tanggal

        $desa_patrang = [
            'Blimbing',
            'Jenggawah',
            'Jepun',
            'Kalirejo',
            'Karangnongko',
            'Kemuning',
            'Kepel',
            'Kranji',
            'Kunir',
            'Mangli',
            'Mlandingan',
            'Patrang',
            'Plumbon',
            'Pucangsewu',
            'Rowobangun',
            'Sumberbendo',
            'Talun',
            'Tlogoagung',
            'Tlogomas',
            'Wuluhan',
        ];

        // Tentukan rentang tanggal dari Januari hingga Mei tahun ini
        $startDate = '2024-01-01';

        return [
            'nik_ibu' => $faker->unique()->numerify('################'), // Generate NIK acak
            'nama_ibu' => $faker->name('female'),
            'tgl_ibu' => $faker->date(),
            'usia' => $faker->numberBetween(20, 40), // Usia antara 20-40 tahun
            'nama_suami' => $faker->name('male'), // Nama suami secara acak
            'alamat' => $faker->randomElement($desa_patrang),
            'created_at' =>
            $faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
            'updated_at' => $faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
        ];
    }
}
