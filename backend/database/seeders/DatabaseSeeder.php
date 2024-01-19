<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Industria;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $industrias = [
            ['id' => '001', 'nombre' => 'Medicina'],
            ['id' => '002', 'nombre' => 'Veterinaria'],
            ['id' => '003', 'nombre' => 'Agencia de Marketing'],
            ['id' => '004', 'nombre' => 'Asesorías y Cursos'],
            ['id' => '005', 'nombre' => 'Tienda de ropa y accesorios'],
            ['id' => '006', 'nombre' => 'Centros de belleza'],
            ['id' => '007', 'nombre' => 'Tienda de cosméticos'],
            ['id' => '008', 'nombre' => 'Juguetería'],
            ['id' => '009', 'nombre' => 'Supermercado'],
            ['id' => '010', 'nombre' => 'Restaurante'],
            ['id' => '011', 'nombre' => 'Pastelerías y panaderías'],
            ['id' => '012', 'nombre' => 'Tienda de electrodomésticos'],
            ['id' => '013', 'nombre' => 'Librería'],
            ['id' => '014', 'nombre' => 'Concesionarios'],
            ['id' => '999', 'nombre' => 'Otros'],
        ];

        foreach ($industrias as $industria) {
            Industria::create($industria);
        }



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
