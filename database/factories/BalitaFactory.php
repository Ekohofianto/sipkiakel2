<?php

namespace Database\Factories;

use App\Models\Balita;
use App\Models\Ibu;
use Illuminate\Database\Eloquent\Factories\Factory;

class BalitaFactory extends Factory
{
    protected $model = Balita::class;

    public function definition()
    {
        // Tentukan rentang tanggal dari Januari hingga Mei tahun ini
        $startDate = '2024-01-01';

        // Ambil satu ibu secara acak dari database
        $ibu = Ibu::inRandomOrder()->first();

        return [
            'nik_balita' => $this->faker->unique()->numerify('###############'),
            'nama_balita' => $this->faker->name,
            'tgl_balita' =>  $this->faker->dateTimeBetween($startDate, 'now'),
            'usia' => $this->faker->numberBetween(1, 5),
            'nik_ibu' => $ibu->nik_ibu,
            'nama_ibu' => $ibu->nama_ibu,
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'alamat' => $ibu->alamat,
            'created_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
            'updated_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
        ];
    }
}
