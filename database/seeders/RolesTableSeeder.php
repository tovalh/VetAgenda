<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Insertar roles predeterminados
        DB::table('roles')->insert([
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador del sistema',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'usuario',
                'descripcion' => 'Usuario regular',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'super_admin',
                'descripcion' => 'Super administrador con acceso completo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
