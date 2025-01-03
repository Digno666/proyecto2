<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promocion;
use App\Models\Servicio;
use App\Models\DetallePromocion;
use Inertia\Inertia;

class PromocionController extends Controller
{
    public function index(Request $request)
    {
        $query = Promocion::query();

        if ($request->has('buscar') && $request->buscar != '') {
            $query->where('nombre', 'like', '%' . $request->buscar . '%')
                ->orWhere('descripcion', 'like', '%' . $request->buscar . '%');
        }
        $promociones = $query->paginate(5);

        return inertia('Promocion/Index', [
            'promociones' => $promociones
        ]);
    }
    public function create()
    {
        $servicios = Servicio::all();
        return inertia('Promocion/Create', [
            'servicios' => $servicios,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombrePromocion' => 'required|string|max:255',
            'descripcionPromocion' => 'required|string|max:1000',
            'serviciosSeleccionados' => 'required|array|min:1',
            'serviciosSeleccionados.*.id' => 'required|exists:S ervicio,codServicio',
            'imagenPromocion' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $imageUrl = null;
        if ($request->hasFile('imagenPromocion')) {
            $file = $request->file('imagenPromocion');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $fileName);
            $imageUrl = $fileName;
        }
        $serviciosSeleccionados = $request->serviciosSeleccionados;
        $promocion = Promocion::create([
            'nombre' => $request->nombrePromocion,
            'descripcion' => $request->descripcionPromocion,
            'imagen' => $imageUrl,
            'precioUnitario' => $request->totalConDescuento,
        ]);
        foreach ($serviciosSeleccionados as $servicio) {
            DetallePromocion::create([
                'codPromocion' => $promocion->codPromocion,
                'codServicio' => $servicio['id'],
            ]);
        }

        return redirect()->route('promocion.index')->with('success', 'Promoción registrada correctamente.');
    }
    public function edit($id)
    {
        $promocion = Promocion::with('servicios')->findOrFail($id);
        $servicios = Servicio::all();
        return Inertia::render('Promocion/Edit', [
            'promocion' => $promocion,
            'servicios' => $servicios
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $validated = $request->validate([
            'nombrePromocion' => 'required|string|max:255',
            'descripcionPromocion' => 'required|string|max:1000',
            'precioUnitario' => 'required|numeric',
            'totalConDescuento' => 'required|numeric',
            'imagenPromocion' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'serviciosSeleccionados' => 'required|array|min:1',
            'serviciosSeleccionados.*.id' => 'exists:servicio,codServicio'
        ]);
        $promocion = Promocion::findOrFail($id);
        
        // Actualizar la promoción con los datos validados
        $promocion->update([
            'nombre' => $validated['nombrePromocion'],
            'descripcion' => $validated['descripcionPromocion'],
            'precioUnitario' => $validated['precioUnitario'],
        ]);

        // Actualizar los servicios asociados
        $promocion->servicios()->sync(array_column($validated['serviciosSeleccionados'], 'id'));

        $newImageUrl = $promocion->imagen; // Mantener la imagen actual por defecto
    
        if ($request->hasFile('imagenPromocion')) {
            $file = $request->file('imagenPromocion');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/uploads'), $fileName);
            $newImageUrl = $fileName;
            $oldImagePath = public_path('storage/uploads/' . $producto->imagen_url);
            if ($producto->imagen_url && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $promocion->update(['imagen' => $newImageUrl]);
        return redirect()->route('promocion.index')->with('success', 'Promoción actualizada con éxito');
    }

}
