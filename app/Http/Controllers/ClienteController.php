<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use App\Models\Pago;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $criterio = $request->get('criterio', '');
        $buscar = $request->get('buscar', '');

        $clientes = Cliente::when($criterio, function ($query) use ($criterio, $buscar) {
            return $query->where($criterio, 'LIKE', '%' . $buscar . '%');
        })->paginate(5); 

        return Inertia::render('Cliente/Index', [
            'clientes' => $clientes,
            'criterio' => $criterio,
            'buscar' => $buscar,
        ]);
    }
    public function create()
    {
        return Inertia::render('Cliente/Create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'carnetIdentidad' => 'required|digits_between:8,10|unique:Cliente,carnetIdentidad',
            'nombre' => 'required|string|min:3|max:30',
            'apellidoPaterno' => 'required|string|min:3|max:30',
            'apellidoMaterno' => 'required|string|min:3|max:30',
            'sexo' => 'required|in:masculino,femenino',
            'edad' => 'required|integer|between:8,100',
            'telefono' => 'required|digits_between:8,10',
            'nombreUsuario' => 'required|string|min:4|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return Inertia::render('Cliente/Create', [
                'errors' => $validator->errors()
            ]);
        }

        $codTipoUsuario = 1;
        $user = User::create([
            'name' => $request->input('nombreUsuario'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), 
            'codTipoUsuarioF' => $codTipoUsuario,
        ]);
        Cliente::create([
            'carnetIdentidad' => $request->input('carnetIdentidad'),
            'nombre' => $request->input('nombre'),
            'apellidoPaterno' => $request->input('apellidoPaterno'),
            'apellidoMaterno' => $request->input('apellidoMaterno'),
            'sexo' => $request->input('sexo'),
            'edad' => $request->input('edad'),
            'telefono' => $request->input('telefono'),
            'codUsuarioF' => $user->codUsuario,  
        ]);
        return Inertia::render('Cliente/Index', [
            'successMessage' => 'Cliente registrado con éxito'
        ]);
    }

    public function edit($carnetIdentidad)
    {
        $cliente = Cliente::findOrFail($carnetIdentidad); 
        return Inertia::render('Cliente/Edit', [
            'cliente' => $cliente
        ]);
    }
    public function update(Request $request, $carnetIdentidad)
    {
        $request->validate([
            'carnetIdentidad' => 'required|digits_between:8,10|unique:Cliente,carnetIdentidad,' . $carnetIdentidad . ',carnetIdentidad',
            'nombre' => 'required|string|min:3|max:30',
            'apellidoPaterno' => 'required|string|min:3|max:30',
            'apellidoMaterno' => 'required|string|min:3|max:30',
            'sexo' => 'required|in:masculino,femenino',
            'telefono' => 'required|digits_between:8,10',
            'edad' => 'required|integer|min:8|max:100',
        ]);

        $cliente = Cliente::findOrFail($carnetIdentidad);
        $cliente->update($request->all());

        return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy($carnetIdentidad)
    {
        $cliente = Cliente::where('carnetIdentidad', $carnetIdentidad)->first();

        if (!$cliente) {
            return Inertia::render('Error', ['message' => 'Cliente no encontrado']);
        }
        $pagos = Pago::where('codClienteF', $carnetIdentidad)->get();

        if ($pagos->isNotEmpty()) {
            return Inertia::render('Cliente/Index', [
                'error' => 'Este cliente tiene pagos asociados y no puede ser eliminado.'
            ]);
        }
        $cliente->delete();
        return redirect()->route('cliente.index');
    }

    public function buscar(Request $request)
    {
        $query = $request->input('query');
        if (empty($query) || strlen($query) < 2) {
            return response()->json([]);
        }
        $clientes = Cliente::where('nombre', 'like', "%$query%")
                   ->orWhere('apellidoPaterno', 'like', "%$query%")
                   ->orWhere('telefono', 'like', "%$query%")
                   ->orWhere('carnetIdentidad', 'like', "%$query%") 
                   ->get(['carnetIdentidad', 'nombre', 'apellidoPaterno', 'apellidoMaterno', 'telefono']);
        return response()->json($clientes);
    }


}
