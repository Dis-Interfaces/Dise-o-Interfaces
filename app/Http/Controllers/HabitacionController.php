<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacion;
use App\Models\Hoteles;
use Illuminate\Validation\Rule;

class HabitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('Habitaciones.Index', compact('habitaciones'));
    }
    public function create()
    {
        return view('Habitaciones.Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|in:1,2,3,4,5',  
            'numero_habitacion' => [
                'required',
                'string',
                'regex:/^\d{3}$/', 
                Rule::unique('habitaciones', 'numero_habitacion')->where(function ($query) use ($request) {
                    return $query->where('hotel_id', $request->hotel_id);
                }),
            ],            
            'tarifa' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,ocupada,mantenimiento',
            'piso' => 'required|in:1,2,3',
        ], [
            'hotel_id.required' => 'El ID del hotel es obligatorio.',
            'hotel_id.exists' => 'El hotel seleccionado no existe.',
            'tipo_habitacion_id.required' => 'El tipo de habitación es obligatorio.',
            'tipo_habitacion_id.in' => 'El tipo de habitación debe ser una opción válida (1, 2, 3, 4, 5).',
            'numero_habitacion.required' => 'El número de habitación es obligatorio.',
            'numero_habitacion.string' => 'El número de habitación debe ser una cadena de texto.',
            'numero_habitacion.regex' => 'El número de habitación debe tener exactamente tres dígitos (ejemplo: 001).',
            'numero_habitacion.unique' => 'El número de habitación ya existe en este hotel.',
            'tarifa.required' => 'La tarifa es obligatoria.',
            'tarifa.numeric' => 'La tarifa debe ser un número.',
            'tarifa.min' => 'La tarifa debe ser un valor positivo.',
            'estado.required' => 'El estado de la habitación es obligatorio.',
            'estado.in' => 'El estado de la habitación debe ser "disponible", "ocupada" o "mantenimiento".',
            'piso.required' => 'El piso es obligatorio.',
            'piso.in' => 'El piso debe ser 1, 2 o 3.',
        ]);
        

        Habitacion::create($request->all());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación creada con éxito.');
    }

    public function edit($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('Habitaciones.Edit', compact('habitacion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hotel_id' => 'required|exists:hoteles,id',
            'tipo_habitacion_id' => 'required|in:1,2,3,4,5',
            'tarifa' => 'required|numeric|min:0',
            'estado' => 'required|in:disponible,ocupada,mantenimiento',
            'piso' => 'required|in:1,2,3',
        ], [
            'hotel_id.required' => 'El ID del hotel es obligatorio.',
            'hotel_id.exists' => 'El hotel seleccionado no existe.',
            'tipo_habitacion_id.required' => 'El tipo de habitación es obligatorio.',
            'tipo_habitacion_id.in' => 'El tipo de habitación debe ser una opción válida (1, 2, 3, 4, 5).',
            'tarifa.required' => 'La tarifa es obligatoria.',
            'tarifa.numeric' => 'La tarifa debe ser un número.',
            'tarifa.min' => 'La tarifa debe ser un valor positivo.',
            'estado.required' => 'El estado de la habitación es obligatorio.',
            'estado.in' => 'El estado de la habitación debe ser "disponible", "ocupada" o "mantenimiento".',
            'piso.required' => 'El piso es obligatorio.',
            'piso.in' => 'El piso debe ser 1, 2 o 3.',
        ]);
    
        if ($request->original_numero_habitacion != $request->numero_habitacion) {
            $request->validate([
                'numero_habitacion' => [
                    'required',
                    'string',
                    'regex:/^\d{3}$/',
                    Rule::unique('habitaciones', 'numero_habitacion')->where(function ($query) use ($request) {
                        return $query->where('hotel_id', $request->hotel_id);
                    }),
                ]
            ], [
                'numero_habitacion.required' => 'El número de habitación es obligatorio.',
                'numero_habitacion.string' => 'El número de habitación debe ser una cadena de texto.',
                'numero_habitacion.regex' => 'El número de habitación debe tener exactamente tres dígitos (ejemplo: 001).',
                'numero_habitacion.unique' => 'El número de habitación ya existe en este hotel.',
            ]);
        }
    
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

    public function disponibles(Request $request)
    {
        $hotelId = $request->input('hotel_id');
        $tipoReservacion = $request->input('tipo_reservacion');

       
        if (!$hotelId || !$tipoReservacion) {
            return response()->json([], 400);
        }

        $habitaciones = Habitacion::where('hotel_id', $hotelId)
            ->where('estado', 'disponible') 
            ->when($tipoReservacion === 'individual', function ($query) {
                $query->whereIn('tipo_habitacion_id', [1, 2]); 
            })
            ->when($tipoReservacion === 'grupal', function ($query) {
                $query->whereIn('tipo_habitacion_id', [3, 4]);
            })
            ->get();

        return response()->json($habitaciones);
    }

    public function show()
    {
        $hoteles = Hoteles::all();
        return view('Public_Views.habitacion', compact('hoteles'));
    }

    public function show2()
    {
        $hoteles = Hoteles::all();
        return view('Public_Views.habitacion2', compact('hoteles'));
    }

    public function show3()
    {
        $hoteles = Hoteles::all();
        return view('Public_Views.habitacion3', compact('hoteles'));
    }

}
