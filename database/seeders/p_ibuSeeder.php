<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\p_ibu;

class p_ibuSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 data p_ibu
        p_ibu::factory()->count(500)->create();
    }
}
