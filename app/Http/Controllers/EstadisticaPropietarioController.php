<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagina;
use Inertia\Inertia;

class EstadisticaPropietarioController extends Controller
{
    public function getPageStatistics()
{
    // Total de visitas
    $totalVisitas = Pagina::sum('conteoVisitas');
    
    // Página más visitada
    $paginaMasVisitada = Pagina::orderBy('conteoVisitas', 'desc')->first();

    // Páginas más visitadas (para el gráfico)
    $topPages = Pagina::orderBy('conteoVisitas', 'desc')->limit(5)->get();

    return Inertia::render('propietario', [
        'stats' => [
            'totalVisits' => $totalVisitas,
            'mostVisitedPage' => $paginaMasVisitada,
            'topVisitedPages' => $topPages,
        ]
    ]);
}

}
