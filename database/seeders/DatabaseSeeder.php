<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Encomienda;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Cliente::factory(25000)->create();
        //Empleado::factory(20)->create();
        Encomienda::factory(10)->create();
    }
}
