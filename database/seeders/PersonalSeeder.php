<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonalSeeder extends Seeder
{
    public function run()
    {
        // Limpiar la tabla 
        DB::table('personal')->delete();

        
        DB::table('personal')->insert([
           
            [
                'nombre' => 'Juan Pérez',
                'puesto' => 'Gerente',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2022-05-01'),
                'tarea_asignada' => 'Supervisión general',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '17:00:00',
                'acceso' => 'Admin',
                'area_asignada' => 'Recepción',
                'estado' => 'Activo',
                'email' => 'juan.perez@solhotel.com',
                'telefono' => '1234567890',
                'id_hotel' => 1,  
                'id_rol' => 3,    
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana Gómez',
                'puesto' => 'Recepcionista',
                'turno' => 'Tarde',
                'fecha_ingreso' => Carbon::parse('2023-08-15'),
                'tarea_asignada' => 'Atención al cliente',
                'hora_entrada' => '14:00:00',
                'hora_salida' => '22:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Recepción',
                'estado' => 'Activo',
                'email' => 'ana.gomez@solhotel.com',
                'telefono' => '2345678901',
                'id_hotel' => 1,
                'id_rol' => 2,     
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos Martínez',
                'puesto' => 'Cocinero',
                'turno' => 'Noche',
                'fecha_ingreso' => Carbon::parse('2021-02-10'),
                'tarea_asignada' => 'Preparación de alimentos',
                'hora_entrada' => '22:00:00',
                'hora_salida' => '06:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Cocina',
                'estado' => 'Activo',
                'email' => 'carlos.martinez@solhotel.com',
                'telefono' => '3456789012',
                'id_hotel' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laura Rodríguez',
                'puesto' => 'Limpieza',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2023-03-12'),
                'tarea_asignada' => 'Limpieza de habitaciones',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '16:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Limpieza',
                'estado' => 'Activo',
                'email' => 'laura.rodriguez@solhotel.com',
                'telefono' => '4567890123',
                'id_hotel' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis Pérez',
                'puesto' => 'Camarero',
                'turno' => 'Tarde',
                'fecha_ingreso' => Carbon::parse('2022-11-05'),
                'tarea_asignada' => 'Atención en el bar',
                'hora_entrada' => '14:00:00',
                'hora_salida' => '22:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Restaurante',
                'estado' => 'Activo',
                'email' => 'luis.perez@solhotel.com',
                'telefono' => '5678901234',
                'id_hotel' => 1,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedro González',
                'puesto' => 'Admin sistema',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2022-01-10'),
                'tarea_asignada' => 'Mantenimiento de sistema',
                'hora_entrada' => '09:00:00',
                'hora_salida' => '17:00:00',
                'acceso' => 'Admin',
                'area_asignada' => 'Sistema',
                'estado' => 'Activo',
                'email' => 'pedro.gonzalez@solhotel.com',
                'telefono' => '6789012345',
                'id_hotel' => 1,
                'id_rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María López',
                'puesto' => 'Gerente',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2021-06-21'),
                'tarea_asignada' => 'Supervisión general',
                'hora_entrada' => '08:00:00',
                'hora_salida' => '17:00:00',
                'acceso' => 'Admin',
                'area_asignada' => 'Recepción',
                'estado' => 'Activo',
                'email' => 'maria.lopez@lunahotel.com',
                'telefono' => '1234567890',
                'id_hotel' => 2,
                'id_rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Verónica Sánchez',
                'puesto' => 'Recepcionista',
                'turno' => 'Noche',
                'fecha_ingreso' => Carbon::parse('2023-03-15'),
                'tarea_asignada' => 'Atención al cliente',
                'hora_entrada' => '22:00:00',
                'hora_salida' => '06:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Recepción',
                'estado' => 'Activo',
                'email' => 'veronica.sanchez@lunahotel.com',
                'telefono' => '9876543210',
                'id_hotel' => 2,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'José Martínez',
                'puesto' => 'Cocinero',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2023-06-30'),
                'tarea_asignada' => 'Preparación de alimentos',
                'hora_entrada' => '07:00:00',
                'hora_salida' => '15:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Cocina',
                'estado' => 'Activo',
                'email' => 'jose.martinez@lunahotel.com',
                'telefono' => '1122334455',
                'id_hotel' => 2,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sofía Ríos',
                'puesto' => 'Camarero',
                'turno' => 'Tarde',
                'fecha_ingreso' => Carbon::parse('2023-01-10'),
                'tarea_asignada' => 'Atención en el bar',
                'hora_entrada' => '14:00:00',
                'hora_salida' => '22:00:00',
                'acceso' => 'User',
                'area_asignada' => 'Restaurante',
                'estado' => 'Activo',
                'email' => 'sofia.rios@estrellahotel.com',
                'telefono' => '1231231231',
                'id_hotel' => 3,
                'id_rol' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos Jiménez',
                'puesto' => 'Admin sistema',
                'turno' => 'Mañana',
                'fecha_ingreso' => Carbon::parse('2021-11-12'),
                'tarea_asignada' => 'Mantenimiento de sistema',
                'hora_entrada' => '09:00:00',
                'hora_salida' => '17:00:00',
                'acceso' => 'Admin',
                'area_asignada' => 'Sistema',
                'estado' => 'Activo',
                'email' => 'carlos.jimenez@estrellahotel.com',
                'telefono' => '6546546547',
                'id_hotel' => 3,
                'id_rol' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
