<?php
namespace App\Http\Controllers;

use App\Models\Reservacion;
use App\Models\Hoteles;
use App\Models\Habitacion;
use App\Models\Inventario;
use App\Models\Promociones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;



class ReservacionesController extends Controller
{
    public function create(Request $request)
    {

        $hoteles = Hoteles::all();
    
        //promociones activas
        $promociones = Promociones::where('activo', true)
            ->whereDate('fecha_inicio', '<=', now())
            ->whereDate('fecha_fin', '>=', now())
            ->get();
    
        // habitaciones disponibles dependiendo el hotel y tipo_habitacion
        $habitaciones = [];
        if ($request->has('hotel_id') && $request->has('tipo_habitacion_id')) {
            $habitaciones = Habitacion::where('hotel_id', $request->hotel_id)
                ->where('tipo_habitacion_id', $request->tipo_habitacion_id)
                ->where('estado', 'disponible')
                ->select('id', 'numero_habitacion', 'tarifa', 'piso') 
                ->get();

                
        }
    
        // se traen los productos de la tabla inventario
        $inventario = [];
        if ($request->has('hotel_id')) {
            $inventario = Inventario::where('hotel_id', $request->hotel_id)
                ->get(['id_producto', 'nombre_producto', 'cantidad', 'descripcion']);
        }
    
        if ($request->has('hotel_id')) {
            $inventario = Inventario::where('hotel_id', $request->hotel_id)
                ->get(['id_producto', 'nombre_producto', 'cantidad', 'descripcion']); 
        }
        
        return view('Modulo_Reservaciones.create', compact('hoteles', 'promociones', 'habitaciones', 'inventario'));
    }
    

    public function store(Request $request)
    {
        // dd($request);
        // dd(gettype($request->habitaciones));
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:users,id',
            'hotel_id' => 'required|exists:hoteles,id',
            'fecha_entrada' => 'required|date|after:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'habitaciones' => 'required|exists:habitaciones,id', // Cambiado a una única habitación
            'inventario' => 'nullable|array',
            'inventario.*.id' => 'exists:inventario,id_producto',
            'inventario.*.cantidad' => 'required|integer|min:1',
            'codigo_promocional' => 'nullable|exists:promociones,codigo_promocional',
            'notas' => 'nullable|string',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
        ]);
        
        //trae el id del usuario loggeado
        $clienteId = Auth::id(); 
        $hotelId = $request->hotel_id;
        $habitacionId = $request->habitaciones;

        // disponibilidad de habitaciones
        $habitacionesSeleccionadas = Habitacion::where('id', $request->habitaciones)
            ->where('hotel_id', $hotelId)
            ->where('estado', 'disponible')
            ->get();
    
        // if ($habitacionesSeleccionadas->count() !== count($request->habitaciones)) {
        //     return back()->withErrors(['habitaciones' => 'Algunas habitaciones seleccionadas ya no están disponibles.']);
        // }
        // dd($habitacionId);

        // calcular noches 
        $noches = now()->parse($request->fecha_entrada)->diffInDays($request->fecha_salida);
    
        // calcular monto total
        $montoTotal = $habitacionesSeleccionadas->sum('tarifa') * $noches;
    
        // aplicar descuento si se usa un código promocional
        $descuento = 0;
        if ($request->codigo_promocional) {
            $promocion = Promociones::where('codigo_promocional', $request->codigo_promocional)->first();
            $descuento = ($promocion->descuento / 100) * $montoTotal;
        }
    
        // dd();
        $reservacion = Reservacion::create([
            'cliente_id' => $clienteId,
            'hotel_id' => $hotelId,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'noches' => $noches,
            'monto_total' => $montoTotal - $descuento,
            'codigo_promocional' => $request->codigo_promocional,
            'descuento_aplicado' => $descuento,
            'notas' => $request->notas,
            'metodo_pago' => 'paypal',
            'estado' => true,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
        ]);

       
        foreach ($habitacionesSeleccionadas as $habitacion) {
            $reservacion->habitaciones()->attach($habitacion->id, ['tarifa' => $habitacion->tarifa]);
        }
    
        // cambiar estado de las habitaciones
        Habitacion::where('id', $request->habitaciones)->update(['estado' => 'ocupada']);
    
        if ($request->inventario) {
            foreach ($request->inventario as $item) {
                $producto = Inventario::find($item['id']);
                if ($producto->cantidad < $item['cantidad']) {
                    return back()->withErrors(['inventario' => 'No hay suficiente stock para el producto: ' . $producto->nombre_producto]);
                }
                $producto->decrement('cantidad', $item['cantidad']);
            }
        }
    
        return redirect()->route('reservaciones.index')
            ->with('success', 'Reservación creada con éxito.');
    }

    public function store2(Request $request)
    {
        // dd($request);
        // dd(gettype($request->habitaciones));
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:users,id',
            'hotel_id' => 'required|exists:hoteles,id',
            'fecha_entrada' => 'required|date|after:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'habitaciones' => 'required|exists:habitaciones,id', // Cambiado a una única habitación
            'inventario' => 'nullable|array',
            'inventario.*.id' => 'exists:inventario,id_producto',
            'inventario.*.cantidad' => 'required|integer|min:1',
            'codigo_promocional' => 'nullable|exists:promociones,codigo_promocional',
            'notas' => 'nullable|string',
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:255',
        ]);
        
        //trae el id del usuario loggeado
        $clienteId = Auth::id(); 
        $hotelId = $request->hotel_id;
        $habitacionId = $request->habitaciones;

        // disponibilidad de habitaciones
        $habitacionesSeleccionadas = Habitacion::where('id', $request->habitaciones)
            ->where('hotel_id', $hotelId)
            ->where('estado', 'disponible')
            ->get();
    
        // if ($habitacionesSeleccionadas->count() !== count($request->habitaciones)) {
        //     return back()->withErrors(['habitaciones' => 'Algunas habitaciones seleccionadas ya no están disponibles.']);
        // }
        // dd($habitacionId);

        // calcular noches 
        $noches = now()->parse($request->fecha_entrada)->diffInDays($request->fecha_salida);
    
        // calcular monto total
        $montoTotal = $habitacionesSeleccionadas->sum('tarifa') * $noches;
    
        // aplicar descuento si se usa un código promocional
        $descuento = 0;
        if ($request->codigo_promocional) {
            $promocion = Promociones::where('codigo_promocional', $request->codigo_promocional)->first();
            $descuento = ($promocion->descuento / 100) * $montoTotal;
        }
    
        // dd();
        $reservacion = Reservacion::create([
            'cliente_id' => $clienteId,
            'hotel_id' => $hotelId,
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'noches' => $noches,
            'monto_total' => $montoTotal - $descuento,
            'codigo_promocional' => $request->codigo_promocional,
            'descuento_aplicado' => $descuento,
            'notas' => $request->notas,
            'metodo_pago' => 'paypal',
            'estado' => true,
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
        ]);

       
        foreach ($habitacionesSeleccionadas as $habitacion) {
            $reservacion->habitaciones()->attach($habitacion->id, ['tarifa' => $habitacion->tarifa]);
        }
    
        // cambiar estado de las habitaciones
        Habitacion::where('id', $request->habitaciones)->update(['estado' => 'ocupada']);
    
        if ($request->inventario) {
            foreach ($request->inventario as $item) {
                $producto = Inventario::find($item['id']);
                if ($producto->cantidad < $item['cantidad']) {
                    return response()->json(['error' => 'No hay suficiente stock para el producto: ' . $producto->nombre_producto], 400);
                }
                $producto->decrement('cantidad', $item['cantidad']);
            }
        }

        return response()->json(['success' => 'Reservación creada con éxito.']);
    }
    

public function filtrarDatos(Request $request)
{
    $hotelId = $request->input('hotel_id');
    $tipoHabitacionId = $request->input('tipo_habitacion_id');

   
    $habitaciones = Habitacion::where('hotel_id', $hotelId)
        ->where('tipo_habitacion_id', $tipoHabitacionId)
        ->where('estado', 'disponible')
        ->get();

   
    $inventario = Inventario::where('hotel_id', $hotelId)->get();

    return response()->json([
        'habitaciones' => $habitaciones,
        'inventario' => $inventario
    ]);
}

public function actualizarInventario(Request $request)
{
    $idProducto = $request->input('id_producto');
    $nuevaCantidad = $request->input('cantidad');

    $producto = Inventario::find($idProducto);
    if ($producto) {
        $producto->cantidad = $nuevaCantidad;
        $producto->save();

        return response()->json(['message' => 'Cantidad actualizada correctamente']);
    }

    return response()->json(['message' => 'Producto no encontrado'], 404);
}

public function getHabitacionesInventario(Request $request)
{
    $hotelId = $request->input('hotel_id');
    $tipoHabitacionId = $request->input('tipo_habitacion_id');

    $habitaciones = Habitacion::where('hotel_id', $hotelId)
        ->where('tipo_habitacion_id', $tipoHabitacionId)
        ->where('estado', 'disponible')
        ->get();

    $inventario = Inventario::where('hotel_id', $hotelId)->get();

    return response()->json([
        'habitaciones' => $habitaciones,
        'inventario' => $inventario
    ]);
}


public function index()
{
    $reservaciones = Reservacion::with(['habitaciones', 'cliente', 'hotel'])->get();

    return view('Modulo_Reservaciones.index', compact('reservaciones'));
}


public function edit($id)
{
    $reservacion = Reservacion::with(['habitaciones'])->findOrFail($id);

    $hoteles = Hoteles::all();

    $promociones = Promociones::where('activo', true)
        ->whereDate('fecha_inicio', '<=', now())
        ->whereDate('fecha_fin', '>=', now())
        ->get();

    $habitaciones = $reservacion->habitaciones;

    return view('Modulo_Reservaciones.edit', compact('reservacion', 'hoteles', 'promociones', 'habitaciones'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'cliente_id' => 'nullable|exists:users,id',
        'hotel_id' => 'required|exists:hoteles,id',
        'fecha_entrada' => 'required|date|after:today',
        'fecha_salida' => 'required|date|after:fecha_entrada',
        'habitaciones' => 'required|exists:habitaciones,id',
        'codigo_promocional' => 'nullable|exists:promociones,codigo_promocional',
        'notas' => 'nullable|string',
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'direccion' => 'required|string|max:255',
    ]);

    $reservacion = Reservacion::findOrFail($id);
    $habitacionActual = $reservacion->habitaciones()->pluck('id');

   
    if ($request->habitaciones != $habitacionActual) {
        Habitacion::whereIn('id', $habitacionActual)->update(['estado' => 'disponible']);
        Habitacion::where('id', $request->habitaciones)->update(['estado' => 'ocupada']);
    }

    $noches = now()->parse($request->fecha_entrada)->diffInDays($request->fecha_salida);
    $habitacionesSeleccionadas = Habitacion::where('id', $request->habitaciones)->get();
    $montoTotal = $habitacionesSeleccionadas->sum('tarifa') * $noches;

    $descuento = 0;
    if ($request->codigo_promocional) {
        $promocion = Promociones::where('codigo_promocional', $request->codigo_promocional)->first();
        $descuento = ($promocion->descuento / 100) * $montoTotal;
    }

    $reservacion->update([
        'cliente_id' => $request->cliente_id,
        'hotel_id' => $request->hotel_id,
        'fecha_entrada' => $request->fecha_entrada,
        'fecha_salida' => $request->fecha_salida,
        'noches' => $noches,
        'monto_total' => $montoTotal - $descuento,
        'codigo_promocional' => $request->codigo_promocional,
        'descuento_aplicado' => $descuento,
        'notas' => $request->notas,
        'nombre' => $request->nombre,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'direccion' => $request->direccion,
    ]);

    return redirect()->route('reservaciones.index')->with('success', 'Reservación actualizada con éxito.');
}


public function show($id)
{
    
    $reservacion = Reservacion::with([
        'habitaciones', 
        'cliente', 
        'hotel', 
    ])->find($id);

    if (!$reservacion) {
        return redirect()->route('reservaciones.index')->with('error', 'Reservación no encontrada.');
    }
    return view('Modulo_Reservaciones.show', compact('reservacion'));
}



public function destroy($id)
{
    $reservacion = Reservacion::findOrFail($id);
    $reservacion->delete();
    return redirect()->route('reservaciones.index')->with('success', 'La reservación ha sido eliminada correctamente.');
}


}