<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Tipopeticion;
use App\Models\User;
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

        Tipopeticion::factory()->create([
            'descripcion'   => 'Aclaratoria de Licencia',
            'activo'        => true
        ]);
        Tipopeticion::factory()->create([
            'descripcion'   => 'Anexos de Radicados en Curso',
            'activo'        => true
        ]);
        Tipopeticion::factory()->create([
            'descripcion'   => 'Derecho de Peticion',
            'activo'        => true
        ]);
        Tipopeticion::factory()->create([
            'descripcion'   => 'Desistimiento de Licencia',
            'activo'        => true
        ]);
        Tipopeticion::factory()->create([
            'descripcion'   => 'Informacion',
            'activo'        => true
        ]);
        Tipopeticion::factory()->create([
            'descripcion'   => 'Quejas - Reclamos',
            'activo'        => true
        ]);

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
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret123'),
            'role_id' => 1,
        ]);

    }
}
