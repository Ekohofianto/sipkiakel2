<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\balita;
use App\Models\ibu;
use App\Models\p_balita;
use App\Models\p_ibu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'last_name' => '1',
            'password' => 'admin',
            'id_user' => 'admin1',
        ]);
        $this->call([
            IbuSeeder::class,
            p_ibuSeeder::class,
            BalitaSeeder::class,
            p_balitaSeeder::class,
        ]);
    }
}
