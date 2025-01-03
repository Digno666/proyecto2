<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Compra;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    public function index()
    {
        // Contar ventas totales
        $totalSales = Venta::count();

        // Calcular el monto total de las ventas
        $totalSalesAmount = Venta::sum('montoTotal');

        // Contar compras totales
        $totalPurchases = Compra::count();

        // Calcular el monto total de las compras
        $totalPurchasesAmount = Compra::sum('montoTotal');

        // Contar ventas y compras mensuales
        $monthlySales = Venta::whereMonth('fechaVenta', Carbon::now()->month)->count();
        $monthlySalesAmount = Venta::whereMonth('fechaVenta', Carbon::now()->month)->sum('montoTotal');

        $monthlyPurchases = Compra::whereMonth('fechaCompra', Carbon::now()->month)->count();
        $monthlyPurchasesAmount = Compra::whereMonth('fechaCompra', Carbon::now()->month)->sum('montoTotal');

        // Obtener los productos más vendidos
        $topSellingProducts = DetalleVenta::join('Producto', 'DetalleVenta.codProducto', '=', 'Producto.codProducto')
            ->select('DetalleVenta.codProducto', 'Producto.nombre', 'Producto.imagen', DB::raw('count(*) as count'))
            ->groupBy('DetalleVenta.codProducto', 'Producto.nombre', 'Producto.imagen')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        $products = [];
        foreach ($topSellingProducts as $item) {
            $imageUrl = $item->imagen ? asset('storage/uploads/' . $item->imagen) : null;

            $products[] = [
                'codProducto' => $item->codProducto,
                'name' => $item->nombre,
                'count' => $item->count,
                'imageUrl' => $imageUrl
            ];
        }

        // Asignar el producto más vendido (el primero del listado)
        $topSellingProduct = $products[0] ?? null;

        // Retornar la vista con los datos
        return Inertia::render('encargado', [
            'stats' => [
                'totalSales' => $totalSales,
                'totalSalesAmount' => $totalSalesAmount,
                'totalPurchases' => $totalPurchases,
                'totalPurchasesAmount' => $totalPurchasesAmount,
                'monthlySales' => $monthlySales,
                'monthlySalesAmount' => $monthlySalesAmount,
                'monthlyPurchases' => $monthlyPurchases,
                'monthlyPurchasesAmount' => $monthlyPurchasesAmount,
                'topSellingProducts' => $products, // Enviar productos más vendidos
                'topSellingProduct' => $topSellingProduct, // Producto más vendido
            ],
        ]);
    }
}
