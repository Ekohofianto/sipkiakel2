<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ibu;

class IbuSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 data ibu
        Ibu::factory()->count(100)->create();
    }
}
