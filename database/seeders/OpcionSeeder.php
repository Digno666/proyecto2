<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Opcion;

class OpcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $opciones = [
            // Opciones para Modulo Venta
            ['nombre' => 'Realizar Venta', 'ruta' => 'venta.index', 'icono' => 'fas fa-cart-arrow-down', 'codMenuF' => 2],
            ['nombre' => 'Gestionar Cliente', 'ruta' => 'cliente.index', 'icono' => 'fas fa-user', 'codMenuF' => 2],

            // Opciones para Modulo Compra
            ['nombre' => 'Gestionar Proveedor', 'ruta' => 'proveedor.index', 'icono' => 'fas fa-truck', 'codMenuF' => 1],
            ['nombre' => 'Gestionar Producto', 'ruta' => 'producto.index', 'icono' => 'fas fa-box', 'codMenuF' => 1],
            ['nombre' => 'Gestionar Categoría', 'ruta' => 'categoria.index', 'icono' => 'fas fa-tags', 'codMenuF' => 1],
            ['nombre' => 'Realizar Compra', 'ruta' => 'compra.index', 'icono' => 'fas fa-receipt', 'codMenuF' => 1],

            // Opciones para Modulo Servicio
            ['nombre' => 'Gestionar Promoción', 'ruta' => 'promocion.index', 'icono' => 'fas fa-users', 'codMenuF' => 3],
            ['nombre' => 'Gestionar Reserva', 'ruta' => 'reserva.index', 'icono' => 'fas fa-clock', 'codMenuF' => 3],
            ['nombre' => 'Gestionar Servicio', 'ruta' => 'servicio.index', 'icono' => 'fas fa-concierge-bell', 'codMenuF' => 3],

            // Opciones para Modulo Administrador
            ['nombre' => 'Gestionar Usuario', 'ruta' => 'usuario.index', 'icono' => 'fas fa-user-shield', 'codMenuF' => 4],
            ['nombre' => 'Gestionar TipoUsuario', 'ruta' => 'tipoUsuario.index', 'icono' => 'fas fa-user-tag', 'codMenuF' => 4],
            ['nombre' => 'Gestionar Encargado', 'ruta' => 'encargado.index', 'icono' => 'fas fa-user-tie', 'codMenuF' => 4],
        ];

        foreach ($opciones as $opcion) {
            Opcion::create($opcion);
        }
    }
}
