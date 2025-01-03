<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Servicio;
use App\Models\DetalleReserva;
use App\Models\Promocion;
use App\Models\Cliente;
use App\Models\Pago;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ReservaClienteController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        
        // Filtramos las promociones donde estActivo es 1 (o true)
        $promociones = Promocion::where('estActivo', true)
                                ->with('servicios')
                                ->get()
                                ->map(function ($promocion) {
                                    $promocion->imagen = asset('storage/uploads/' . $promocion->imagen);
                                    return $promocion;
                                });

        return Inertia::render('VistaCliente/reservacliente', [
            'servicios' => $servicios,
            'promociones' => $promociones,
        ]);
    }
   public function index2()
    {
        // Obtener el cliente asociado al usuario autenticado
        $cliente = Cliente::where('codUsuarioF', Auth::user()->codUsuario)->first();

        // Si se encuentra el cliente, obtenemos las reservas asociadas a su carnet de identidad
        if ($cliente) {
            // Cargar las relaciones 'servicios' y 'promociones' de cada reserva
            $reservas = Reserva::with(['servicios']) // Asegúrate de cargar 'promociones' también
                                ->where('codClienteF', $cliente->carnetIdentidad)
                                ->get();
        } else {
            $reservas = [];
        }

        // Retornar la respuesta Inertia con los datos de las reservas
        return Inertia::render('VistaCliente/verReseva', [
            'reservas' => $reservas
        ]);
    }


    public function store(Request $request)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'fechaReserva' => 'required|date',
            'servicios' => 'required|array',// Cambiar 'required' a 'array' para validación adecuada
            'montoTotal' => 'required',
            'horaReserva' => 'required',
        ]);

        $user = auth()->user(); // Obtener el usuario logueado
        $cliente = Cliente::where('codUsuarioF', $user->codUsuario)->first(); // Buscar el cliente asociado al usuario logueado

        if (!$cliente) {
            return response()->json(['error' => 'No se encontró el cliente asociado al usuario logueado'], 400);
        }

        // Crear el pago
        $pago = new Pago();
        $pago->fechaPago = now();
        $pago->monto = $validated['montoTotal'];
        $pago->estado = 'pagado';
        $pago->save();

        // Crear la reserva
        $reserva = Reserva::create([
            'fechaReserva' => $validated['fechaReserva'],
            'montoTotal' => $validated['montoTotal'],
            'codTrabajadorF' => 13433302, // Cambiar si es necesario
            'estado' => 'reservado',
            'horaReserva' => $validated['horaReserva'] ?? now()->format('H:i:s'), 
            'codClienteF' => $cliente->carnetIdentidad, // Código del cliente logueado
            'codPagoF' => $pago->codPago,
        ]);

        // Guardar los servicios seleccionados
        foreach ($validated['servicios'] as $codServicio) {
            DetalleReserva::create([
                'codReserva' => $reserva->codReserva,
                'codServicio' => $codServicio,
            ]);
        }

        return redirect()->route('reserva.index');
    }
    // ReservaController.php
    public function cancelarReserva($codReserva)
    {
        // Buscar la reserva por su código
        $reserva = Reserva::find($codReserva);

        if (!$reserva) {
            return response()->json(['success' => false, 'message' => 'Reserva no encontrada'], 404);
        }

        // Verificar si la reserva ya está cancelada
        if ($reserva->estado === 'cancelado') {
            return response()->json(['success' => false, 'message' => 'La reserva ya ha sido cancelada.'], 400);
        }

        // Cambiar el estado a 'cancelado'
        $reserva->estado = 'cancelado';
        $reserva->save();

        return response()->json(['success' => true, 'message' => 'Reserva cancelada con éxito']);
    }
    public function getHorasOcupadas(Request $request)
    {
        $fechaReserva = $request->input('fechaReserva');
        $horaReserva = $request->input('horaReserva');
        $reservaExistente = Reserva::where('fechaReserva', $fechaReserva)
            ->where('horaReserva', $horaReserva)
            ->exists();

        return response()->json(['ocupada' => $reservaExistente]);
        }
}
