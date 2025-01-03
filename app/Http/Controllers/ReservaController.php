<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\DetalleReserva;
use App\Models\Promocion;
use App\Models\Pago;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservaController extends Controller
{
    public function index()
    {
        // Obtener todas las reservas desde la base de datos
        $reservas = Reserva::with('cliente', 'trabajador', 'servicios')->get();
        return Inertia::render('Reserva/Index', [
            'reservas' => $reservas
        ]);
    }
    public function show($id)
    {
        // Obtener la reserva por ID con los detalles de cliente, trabajador y servicios
        $reserva = Reserva::with('cliente', 'trabajador', 'servicios')->findOrFail($id);

        // Retornar la vista con la reserva específica
        return Inertia::render('Reserva/Detalle', [
            'reserva' => $reserva
        ]);
    }


}
