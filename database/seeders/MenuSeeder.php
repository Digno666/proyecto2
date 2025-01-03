<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            [
                'nombre' => 'Modulo Compra',
                'icono' => 'fas fa-shopping-cart',
            ],
            [
                'nombre' => 'Modulo Venta',
                'icono' => 'fas fa-cash-register',
            ],
            [
                'nombre' => 'Modulo Servicio',
                'icono' => 'fas fa-cut',
            ],
            [
                'nombre' => 'Modulo Administrador',
                'icono' => 'fas fa-users',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu); 
        }
    }
}
