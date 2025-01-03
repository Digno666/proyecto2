<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocion;
use Inertia\Inertia;

class PromocionClienteController extends Controller
{
    public function index()
    {
        $promociones = Promocion::all();
        return Inertia::render('VistaCliente/promocioncliente', [
            'promociones' => $promociones
        ]);
    }
}
