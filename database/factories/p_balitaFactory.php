<?php

namespace Database\Factories;

use App\Models\Balita;
use App\Models\p_balita;
use Illuminate\Database\Eloquent\Factories\Factory;

class p_balitaFactory extends Factory
{
    protected $model = p_balita::class;

    public function definition()
    {
        // Tentukan rentang tanggal dari Januari hingga Mei tahun ini
        $startDate = '2024-01-01';

        // Ambil satu balita secara acak dari database
        $balita = Balita::inRandomOrder()->first();

        return [
            'nik_balita' => $balita->nik_balita,
            'nama_balita' => $balita->nama_balita,
            'berat_badan' => $this->faker->randomFloat(2, 2, 20), // Berat badan antara 2kg dan 20kg
            'panjang_badan' => $this->faker->randomFloat(2, 30, 120), // Panjang badan antara 30cm dan 120cm
            'lingkar_kepala' => $this->faker->randomFloat(2, 30, 60), // Lingkar kepala antara 30cm dan 60cm
            'lingkar_lengan' => $this->faker->randomFloat(2, 10, 30), // Lingkar lengan antara 10cm dan 30cm
            'jenis_imunisasi' => $this->faker->randomElement([
                'BCG',
                'Hepatitis B',
                'DTP',
                'Polio',
                'Hib',
                'PCV',
                'MMR',
                'Varisela',
                'HPV',
                'Influenza'
            ]),
            'alamat' => $balita->alamat,
            'created_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
            'updated_at' => $this->faker->dateTimeBetween($startDate, 'now'), // Tanggal acak antara Januari hingga sekarang
        ];
    }
}
