<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PagoController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $cliente = $user->cliente;
        $codUsuario = $request->codUsuario; // El código del cliente (usuario)
        $name = $request->name; // El nombre del cliente
        $porcentajePago = $request->porcentajePago; // El 20% del monto total

        return inertia('Pago/Create', [
            'idcliente' => $cliente->carnetIdentidad, 
            'tcRazonSocial' => $cliente->nombre,
            'tcCiNit' => $cliente->carnetIdentidad, 
            'tnMonto' => $porcentajePago, // Monto total recibido desde el frontend
            'tnTelefono' => $cliente->telefono,
            'tcCorreo' => $user->email, // Enviamos el 20% al frontend
            'codUsuario' => $codUsuario, // Enviamos el código de usuario
            'name' => $name, // Enviamos el nombre del cliente
        ]);
    }
    public function index2(Request $request)
    {
        $user = auth()->user();
        $cliente = $user->cliente;    
        return inertia('Pago/CreateVenta', [
            'idcliente' => $cliente->carnetIdentidad, 
            'tcRazonSocial' => $cliente->nombre,
            'tcCiNit' => $cliente->carnetIdentidad, 
            'tnMonto' => $request->totalCarrito,
            'tnTelefono' => $cliente->telefono,
            'tcCorreo' => $user->email, 
        ]);
    }


}
