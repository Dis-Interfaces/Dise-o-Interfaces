<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;

class HabitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('habitaciones.index', compact('habitaciones'));
    }
    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|in:1,2,3,4,5',  
            'numero_habitacion' => 'required|string|max:10',
            'tarifa' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,ocupada,mantenimiento',
            'piso' => 'required|in:1,2,3',
        ]);

        Habitacion::create($request->all());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación creada con éxito.');
    }

    public function edit($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('habitaciones.edit', compact('habitacion'));
    }

    public function update(Request $request, $id)
    {
        
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|in:1,2,3,4,5',  
            'numero_habitacion' => 'required|string|max:10',
            'tarifa' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,ocupada,mantenimiento',
            'piso' => 'required|in:1,2,3',
        ]);

        $habitacion = Habitacion::findOrFail($id);
        $habitacion->update($request->all());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada con éxito.');
    }


    public function destroy($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        $habitacion->delete();

        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada con éxito.');
    }

    public function habitacionesDisponibles(Request $request)
{
    $hotelId = $request->input('hotel_id');
    $tipoReservacion = $request->input('tipo_reservacion');

    // Validar entrada
    if (!$hotelId || !$tipoReservacion) {
        return response()->json([], 400);
    }

    // Filtrar habitaciones disponibles según el hotel y el tipo de reservación
    $habitaciones = Habitacion::where('hotel_id', $hotelId)
        ->where('estado', 'disponible')
        ->when($tipoReservacion === 'individual', function ($query) {
            $query->whereIn('tipo_habitacion_id', [1, 2]); // Habitaciones sencillas y suites
        })
        ->when($tipoReservacion === 'grupal', function ($query) {
            $query->whereIn('tipo_habitacion_id', [3, 4]); // Habitaciones con varias camas
        })
        ->get();

    return response()->json($habitaciones);
}

}
