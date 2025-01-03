<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $criterio = $request->input('criterio');
        $buscar = $request->input('buscar');
        $query = Servicio::query();
    
        if ($buscar) {
            if ($criterio === 'nombre') {
                $query->where('nombre', 'like', '%' . $buscar . '%');
            } elseif ($criterio === 'descripcion') {
                $query->where('descripcion', 'like', '%' . $buscar . '%');
            }
        }
        $servicios = $query->paginate(5);
    
        return Inertia::render('Servicio/Index', [
            'servicios' => $servicios,
        ]);
    }
    
    public function create()
    {
         return Inertia::render('Servicio/Create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:500',
        ]);

        Servicio::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'precio' => $request->input('precio'),
        ]);

        return redirect()->route('servicio.index')->with('success', 'Servicio creado exitosamente.');
    }

    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        return Inertia::render('Servicio/Edit', [
            'servicio' => $servicio,
            'errors' => session('errors') ?? [], 
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|min:3|max:150',
            'descripcion' => 'required|string',
            'precio' => 'required'
        ]);
        $servicio = Servicio::findOrFail($id);
        $servicio->update([
            'nombre' => $validatedData['nombre'],
            'descripcion' => $validatedData['descripcion'],
            'precio' => $validatedData['precio'],
        ]);
        return Redirect()->route('servicio.index')->with('success', 'El servicio fue actualizado correctamente.');
    }
    public function destroy(Servicio $servicio)
    {
        $servicio->delete();

        return redirect()->route('servicio.index')->with('success', 'Servicio eliminado exitosamente.');
    }
    public function buscar(Request $request)
    {
        $searchTerm = $request->query('search');
    
        // Buscar servicios que coincidan con el término de búsqueda
        $servicios = Servicio::with('precios', 'horario')
                            ->where('nombre', 'like', '%' . $searchTerm . '%')
                            ->orWhere('descripcion', 'like', '%' . $searchTerm . '%')
                            ->get();
    
        // Verificar si la solicitud es AJAX
        if ($request->ajax()) {
            return response()->json($servicios); // Devuelve JSON para solicitudes AJAX
        }
    
        // Si no es una solicitud AJAX, devuelve una respuesta de Inertia
        return Inertia::render('Servicios/Buscar', [
            'servicios' => $servicios
        ]);
    }
    
    public function servicios()
    {
        try {
            $servicios = Servicio::with(['precios', 'horario'])->get();
            return response()->json($servicios);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['error' => 'Error al cargar los servicios: ' . $e->getMessage()], 500);
        }
    }

}
