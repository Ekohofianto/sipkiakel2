<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\p_balita;

class p_balitaSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 data p_balita
        p_balita::factory()->count(1000)->create();
    }
}
