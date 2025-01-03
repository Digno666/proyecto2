<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Opcion;
use App\Models\Menu;

class MenuController extends Controller
{
    public function getMenuOptions()
    {
        $user = Auth::user();
        $tipoUsuario = $user->tipoUsuario;

        // Obtener todos los permisos del tipo de usuario
        $permisos = $tipoUsuario->permisos;

        // Inicializamos el arreglo de menús de forma dinámica
        $menuOptions = [];

        // Iteramos sobre los permisos y recogemos las opciones asociadas
        foreach ($permisos as $permiso) {
            $opcion = Opcion::find($permiso->codOpcionF);
            if ($opcion) {
                $menu = Menu::find($opcion->codMenuF);

                if ($menu) {
                    $menuName = $menu->nombre;
                    $menuIcon = $menu->icono;

                    // Añadir el menú si aún no está en el array
                    if (!isset($menuOptions[$menuName])) {
                        $menuOptions[$menuName] = [
                            'name' => $menuName,
                            'icon' => $menuIcon,
                            'options' => [],
                        ];
                    }

                    // Añadir la opción (submenú) al menú correspondiente
                    $menuOptions[$menuName]['options'][] = [
                        'name' => $opcion->nombre,
                        'icon' => $opcion->icono,
                        'route' => $opcion->ruta, // Genera la URL
                    ];
                }
            }
        }

        // Convertir el array asociativo en una lista (array indexado) de menús
        return response()->json(array_values($menuOptions));
    }
}
