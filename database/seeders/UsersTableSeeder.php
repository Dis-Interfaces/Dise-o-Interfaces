<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Datos base
        $hotels = [1, 2, 3];
    
        // Generar 15 clientes
        for ($i = 1; $i <= 15; $i++) {
            DB::table('users')->updateOrInsert(
                ['email' => "cliente$i@example.com"],
                [
                    'nombre' => "Cliente $i",
                    'apellidos' => "Apellido $i",
                    'password' => Hash::make('password'), // Contraseña genérica
                    'telefono' => null,
                    'direccion' => null,
                    'rol' => 1, // Clientes
                    'estado' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    
        // Generar 15 trabajadores
        for ($i = 1; $i <= 15; $i++) {
            $hotel_id = $hotels[array_rand($hotels)];
            DB::table('users')->updateOrInsert(
                ['email' => "trabajador$i@example.com"],
                [
                    'nombre' => "Trabajador $i",
                    'apellidos' => "Apellido $i",
                    'password' => Hash::make('password'),
                    'telefono' => "555-000-00$i",
                    'direccion' => "Calle Trabajador $i, Ciudad, País",
                    'rol' => 2, // Trabajadores
                    'puesto' => "Puesto $i",
                    'turno' => $i % 2 === 0 ? 'Matutino' : 'Vespertino',
                    'hora_entrada' => $i % 2 === 0 ? '07:00:00' : '14:00:00',
                    'hora_salida' => $i % 2 === 0 ? '15:00:00' : '22:00:00',
                    'fecha_ingreso' => now()->subDays(rand(30, 365)),
                    'area_asignada' => "Área $i",
                    'tarea_asignada' => "Tarea específica asignada $i",
                    'estado' => 1,
                    'id_hotel' => $hotel_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    
        // Generar 3 administradores
        for ($i = 1; $i <= 3; $i++) {
            $hotel_id = $hotels[array_rand($hotels)];
            DB::table('users')->updateOrInsert(
                ['email' => "admin$i@example.com"],
                [
                    'nombre' => "Admin $i",
                    'apellidos' => "Apellido Admin $i",
                    'password' => Hash::make('adminpassword'),
                    'telefono' => "555-100-00$i",
                    'direccion' => "Calle Administrador $i, Ciudad, País",
                    'rol' => 3, // Administradores
                    'puesto' => "Administrador General $i",
                    'turno' => 'Matutino',
                    'hora_entrada' => '08:00:00',
                    'hora_salida' => '17:00:00',
                    'fecha_ingreso' => now()->subDays(rand(365, 730)),
                    'area_asignada' => "Dirección General",
                    'tarea_asignada' => "Gestión de todo el hotel",
                    'estado' => 1,
                    'id_hotel' => $hotel_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
    
}