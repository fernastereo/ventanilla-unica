<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestType::truncate();

        $id = DB::table('request_types')->insertGetId([
            'name'          => 'Aclaratoria de Licencia',
            'description'   => 'Aclaratoria de Licencia previamente expedida',
            'active'        => true
        ]);
    }
}
