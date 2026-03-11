<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Receta;
use App\Models\Menu;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categoria1 = Categoria::create([
            'nombre' => 'Carnes',
            'descripcion' => 'Platos principales a base de carnes'
        ]);

        $categoria2 = Categoria::create([
            'nombre' => 'Ensaladas',
            'descripcion' => 'Ensaladas frescas y saludables'
        ]);

        $categoria3 = Categoria::create([
            'nombre' => 'Postres',
            'descripcion' => 'Dulces y postres deliciosos'
        ]);

        $categoria4 = Categoria::create([
            'nombre' => 'Sopas',
            'descripcion' => 'Sopas y caldos'
        ]);

        $ingredientes = [
            ['nombre' => 'Pollo', 'unidad' => 'kg'],
            ['nombre' => 'Carne molida', 'unidad' => 'kg'],
            ['nombre' => 'Arroz', 'unidad' => 'g'],
            ['nombre' => 'Lechuga', 'unidad' => 'und'],
            ['nombre' => 'Tomate', 'unidad' => 'und'],
            ['nombre' => 'Cebolla', 'unidad' => 'und'],
            ['nombre' => 'Ajo', 'unidad' => 'dientes'],
            ['nombre' => 'Aceite de oliva', 'unidad' => 'ml'],
            ['nombre' => 'Sal', 'unidad' => 'g'],
            ['nombre' => 'Pimienta', 'unidad' => 'g'],
            ['nombre' => 'Huevos', 'unidad' => 'und'],
            ['nombre' => 'Leche', 'unidad' => 'ml'],
            ['nombre' => 'Harina', 'unidad' => 'g'],
            ['nombre' => 'Azúcar', 'unidad' => 'g'],
            ['nombre' => 'Chocolate', 'unidad' => 'g'],
        ];

        foreach ($ingredientes as $ing) {
            Ingrediente::create($ing);
        }

        $receta1 = Receta::create([
            'name' => 'Pollo al Horno',
            'description' => 'Delicioso pollo asado con hierbas',
            'tiempo_preparacion' => 90,
            'porciones' => 4,
            'instrucciones' => '1. Precalentar el horno a 200°C\n2. Sazonar el pollo\n3. Hornear por 1 hora',
            'categoria_id' => $categoria1->id,
        ]);

        $receta2 = Receta::create([
            'name' => 'Ensalada César',
            'descripcion' => 'Ensalada clásica con aderezo César',
            'tiempo_preparacion' => 15,
            'porciones' => 2,
            'instrucciones' => '1. Lavar la lechuga\n2. Agregar crutones\n3. Añadir aderezo',
            'categoria_id' => $categoria2->id,
        ]);

        $receta3 = Receta::create([
            'name' => 'Brownie de Chocolate',
            'descripcion' => 'Postre suave de chocolate',
            'tiempo_preparacion' => 45,
            'porciones' => 8,
            'instrucciones' => '1. Mezjar ingredientes\n2. Hornear a 180°C\n3. Enfriar y servir',
            'categoria_id' => $categoria3->id,
        ]);

        $receta1->ingredientes()->attach([1 => ['cantidad' => 1.5], 8 => ['cantidad' => 50], 9 => ['cantidad' => 10]]);
        $receta2->ingredientes()->attach([4 => ['cantidad' => 1], 5 => ['cantidad' => 2], 8 => ['cantidad' => 30]]);
        $receta3->ingredientes()->attach([11 => ['cantidad' => 2], 13 => ['cantidad' => 200], 14 => ['cantidad' => 150], 15 => ['cantidad' => 100]]);

        $menu1 = Menu::create([
            'nombre' => 'Menú Semanal 1',
            'fecha' => now()->startOfWeek(),
        ]);

        $menu1->recetas()->attach([
            $receta1->id => ['dia_semana' => 'Lunes'],
            $receta2->id => ['dia_semana' => 'Miércoles'],
            $receta3->id => ['dia_semana' => 'Viernes'],
        ]);

        $menu2 = Menu::create([
            'nombre' => 'Menú Semanal 2',
            'fecha' => now()->startOfWeek()->addDays(7),
        ]);

        $menu2->recetas()->attach([
            $receta2->id => ['dia_semana' => 'Martes'],
            $receta1->id => ['dia_semana' => 'Jueves'],
        ]);
    }
}
