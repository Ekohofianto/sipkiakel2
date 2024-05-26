<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Balita;

class BalitaSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 data p_ibu
        Balita::factory()->count(500)->create();
    }
}
