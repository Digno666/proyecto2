<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $criterio = $request->input('criterio', 'fechaCompra');
        $buscar = $request->input('buscar', '');
        $compras = Compra::with(['proveedor', 'trabajador'])
            ->when($buscar, function ($query) use ($criterio, $buscar) {
                return $query->where($criterio, 'like', "%$buscar%");
            })
            ->paginate(5);
        return inertia('Compra/Index', [
            'compras' => $compras,
            'deleteMessage' => session('delete'),
        ]);
    }
    public function create(Request $request)
    {
        // Obtener el usuario autenticado
        $user = $request->user();
        
        // Obtener el trabajador relacionado con el usuario autenticado
        $trabajador = $user->trabajador; // Usar la relación definida en el modelo User
        
        if (!$trabajador) {
            // Si no existe un trabajador relacionado, devolver un error
            return response()->json(['error' => 'El usuario no tiene un trabajador asociado.'], 403);
        }
    
        // Obtener los proveedores y productos
        $proveedores = Proveedor::all();
        $productos = Producto::with('categoria')->get();
    
        return Inertia::render('Compra/Create', [
            'trabajador' => $trabajador, // Enviar trabajador a la vista
            'proveedores' => $proveedores,
            'productos' => $productos,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'fechaCompra' => 'required|date',
            'codTrabajadorF' => 'required|exists:Trabajador,carnetIdentidad',
            'codProveedorF' => 'required|exists:Proveedor,codProveedor',
            'productosSeleccionados' => 'required|json',
            'totalCompra' => 'required|numeric', 
        ]);
        $productosSeleccionados = json_decode($request->productosSeleccionados);

        // Calcular el monto total de la compra
        $montoTotal = 0;
        foreach ($productosSeleccionados as $producto) {
            $montoTotal += $producto->precio * $producto->cantidad;
        }
        $codTrabajadorF =  $request->codTrabajadorF;
        $compra = new Compra();
        $compra->fechaCompra = $request->fechaCompra;
        $compra->codTrabajadorF = $codTrabajadorF;
        $compra->codProveedorF = $request->codProveedorF;
        $compra->montoTotal = $request->totalCompra;
        $compra->save();

        // Registrar los detalles de la compra
        foreach ($productosSeleccionados as $producto) {
            $detalleCompra = new DetalleCompra();
            $detalleCompra->codCompra = $compra->codCompra;
            $detalleCompra->codProducto = $producto->id;
            $detalleCompra->cantidad = $producto->cantidad;
            $detalleCompra->precioC = $producto->precio;
            $detalleCompra->save();
        }
        return Inertia::render('Compra/Detalle', [
            'compra' => $compra,
            'detalleCompra' => $compra->detalleCompra, 
        ]);
    }
    public function show($codCompra)
{
    // Asegurarse de que el valor de $codCompra es un string
    $codCompra = (string) $codCompra;

    // Buscar la compra con sus relaciones
    $compra = Compra::with(['proveedor', 'trabajador'])->findOrFail($codCompra);

    // Obtener los detalles de la compra
    $detalleCompra = DetalleCompra::where('codCompra', $codCompra)
        ->get()
        ->map(function ($detalle) {
            // Asegurarse que el codProducto sea tratado como un string
            $detalle->codProducto = (string) $detalle->codProducto;

            // Cargar la relación con Producto y aplicar CAST a codProducto
            $detalle->producto = Producto::whereRaw('CAST("codProducto" AS VARCHAR) = ?', [$detalle->codProducto])
                ->first();

            return $detalle;
        });

    // Renderizar la vista con Inertia
    return Inertia::render('Compra/Detalle', [
        'compra' => $compra,
        'detalleCompra' => $detalleCompra
    ]);
}

    


    public function buscarProductos(Request $request)
    {
        $query = $request->input('nombreProducto', '');
        $productos = Producto::where('nombre', 'like', "%$query%")->get();
        return response()->json($productos);
    }

}