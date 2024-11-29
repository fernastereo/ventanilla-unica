<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Fernando E. Cueto',
            'email' => 'fernandoecueto@gmail.com',
            'password' => bcrypt('secret123'),
            'role_id' => 1,
        ]);

        // $this->call(TipopeticionsTableSeeder::class);

    }
}
