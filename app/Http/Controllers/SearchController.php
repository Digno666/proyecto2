<?php

namespace App\Http\Controllers;

use App\Models\Opcion;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchQuery = $request->input('query');
        $user = Auth::user();
        $tipoUsuario = $user->tipoUsuario;

    
        $permisos = $tipoUsuario->permisos;


        $opcionesPermitidas = Opcion::whereIn('codOpcion', $permisos->pluck('codOpcionF')->toArray())
            ->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->get();


        $opcionesResult = $opcionesPermitidas->isEmpty() ? collect() : $opcionesPermitidas->map(function ($opcion) {
            return [
                'type' => 'opcion',
                'nombre' => $opcion->nombre,
                'ruta' => route($opcion->ruta),
                'icono' => 'fas fa-cogs',
            ];
        });

        $proveedores = collect();  
        if ($tipoUsuario->codTipoUsuario == 2) {
            $proveedores = Proveedor::whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                ->orWhereRaw('LOWER(direccion) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                ->get()
                ->map(function ($proveedor) {
                    return [
                        'type' => 'proveedor',
                        'nombre' => $proveedor->nombre,
                        'ruta' => route('proveedor.index', ['buscar' => $proveedor->nombre]),
                        'icono' => 'fas fa-pencil-alt',
                    ];
                });
        }

        $categorias = collect();  
        if ($tipoUsuario->codTipoUsuario == 2) {
            $categorias = Categoria::whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                ->get()
                ->map(function ($categoria) {
                    return [
                        'type' => 'categoria',
                        'nombre' => $categoria->nombre,
                        'ruta' => route('categoria.index', ['buscar' => $categoria->nombre]),
                        'icono' => 'fas fa-tags',
                    ];
                });
        }

        $productos = collect();  
        if ($tipoUsuario->codTipoUsuario == 2) {
            $productos = Producto::whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                ->get()
                ->map(function ($producto) {
                    return [
                        'type' => 'producto',
                        'nombre' => $producto->nombre,
                        'ruta' => route('producto.index', ['buscar' => $producto->nombre]),
                        'icono' => 'fas fa-box',
                    ];
                });
        }

        $servicios = collect();
if ($tipoUsuario->codTipoUsuario == 2) {
    $servicios = Servicio::whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
        ->get()
        ->map(function ($servicio) {
            return [
                'type' => 'servicio',
                'nombre' => $servicio->nombre,
                'ruta' => route('servicio.index', [
                    'criterio' => 'nombre', 
                    'buscar' => $servicio->nombre, 
                ]),
                'icono' => 'fas fa-concierge-bell',
            ];
        });
}


       
        $results = $opcionesResult->merge($proveedores)->merge($categorias)->merge($productos)->merge($servicios);

  
        return response()->json($results->values());  
    }
}
