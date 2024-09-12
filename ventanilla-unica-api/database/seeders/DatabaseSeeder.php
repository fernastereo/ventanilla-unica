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
        // User::factory(10)->create();
        Role::factory()->create([
            'name' => 'Admin',
            'is_active' => true,
        ]);

        Role::factory()->create([
            'name' => 'User',
            'is_active' => true,
        ]);

        Role::factory()->create([
            'name' => 'Client',
            'is_active' => true,
        ]);

        Role::factory()->create([
            'name' => 'User_Client',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'Fernando E. Cueto',
            'email' => 'fernandoecueto@gmail.com',
            'password' => bcrypt('secret123'),
            'role_id' => 1,
        ]);

        Client::factory()->create([
            'name' => 'CSS S.A.S.',
            'email' => 'info@css-sas.com',
            'phone' => '1234567890',
            'address' => 'Calle 123 # 123 - 123',
            'city' => 'Berlin',
            'status' => 'Activo',
            'is_active' => true,
        ]);

        $this->call(TipopeticionsTableSeeder::class);

    }
}
