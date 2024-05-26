<?php

namespace Database\Factories;

use App\Models\Ibu;
use App\Models\p_ibu;
use Illuminate\Database\Eloquent\Factories\Factory;

class p_ibuFactory extends Factory
{
    protected $model = p_ibu::class;

    public function definition()
    {
        // Tentukan rentang tanggal dari Januari hingga Mei tahun ini
        $startDate = '2024-01-01';

        // Ambil satu ibu secara acak dari database
        $ibu = Ibu::inRandomOrder()->first();

        return [
            'nik_ibu' => $ibu->nik_ibu,
            'nama_ibu' => $ibu->nama_ibu,
            'berat_b' => $this->faker->randomFloat(2, 45, 90), // Berat badan antara 45kg dan 90kg
            'tinggi_b' => $this->faker->randomFloat(2, 150, 180), // Tinggi badan antara 150cm dan 180cm
            'tekanan_d' => $this->faker->numberBetween(90, 140) . '/' . $this->faker->numberBetween(60, 90), // Tekanan darah sistolik/diastolik
            'riwayat_p' => $this->faker->randomElement([
                '',
                'Malaria',
                'Hipertensi',
                'Diabetes',
                'Asma',
                'Tuberkulosis',
                'Kolesterol Tinggi',
                'Anemia',
                'Gagal Ginjal',
                'Kanker',
                'Stroke'
            ]),
            'usia_kehamilan' => $this->faker->numberBetween(1, 40), // Usia kehamilan antara 1 dan 40 minggu
            'alamat' => $ibu->alamat,
            'created_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
            'updated_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
        ];
    }
}
