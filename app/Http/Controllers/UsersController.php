<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use DB;

class UsersController extends Controller
{
    /**
     * mostrar los clientes(rol 1)
     */
    public function indexClientes()
    {
        $clientes = User::where('rol', 1)->get(); // solo clientes
        return view('Cliente.Index_Cliente', compact('clientes'));
    }

   /**
 * Mostrar los trabajadores (roles 2 y 3) activos
 */
public function indexPersonal()
{
    // filtra a los trabajadores y admins con estado = 1 (activos)
    $trabajadores = User::whereIn('rol', [2, 3])
                        ->where('estado', 1)  // activos
                        ->get();

    return view('Personal.Index_Personal', compact('trabajadores'));
}


    /**
     * mostrar form de creación clientes
     */
    public function createCliente()
    {
        return view('Cliente.Create_Cliente');
    }

    /**
     * mostrar form de creación trabajadores
     */
    public function createPersonal()
    {
        return view('Personal.Create_Personal');
    }

    /**
     * guardar cliente
     */
    public function storeCliente(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:35',
            'apellidos' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => [
                'required',
                'string',
                'max:15',
                'regex:/^[\+0-9\s\-]*$/',  
            ], 
            'direccion' => 'required|string|max:255', 
            'password' => 'required|string|min:8|confirmed', 
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
            'nombre.max' => 'El campo nombre no debe exceder los 35 caracteres.',
            
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'apellidos.string' => 'El campo apellidos debe ser una cadena de texto.',
            'apellidos.max' => 'El campo apellidos no debe exceder los 55 caracteres.',
            
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.string' => 'El campo correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico no tiene un formato válido.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo teléfono no debe exceder los 15 caracteres.',
            'telefono.regex' => 'El teléfono solo debe contener números, +, espacios y guiones.',
            
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo dirección no debe exceder los 255 caracteres.',
            
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);
        
    
        
        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'password' => $request->password,
            'rol' => 1, // rol cliente
        ]);
    
        return redirect()->route('clientes.index')->with('success', 'Cliente creado con éxito.');
    }
    
    /**
     * guardar trabajador
     */
    public function storePersonal(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:35',
            'apellidos' => 'required|string|max:55',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'puesto' => 'required|string|max:100',
            'turno' => 'required|string|max:50',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i|after:hora_entrada',
            'fecha_ingreso' => 'required|date',
            'area_asignada' => 'required|string|max:100',
            'tarea_asignada' => 'nullable|string|max:255',
            'id_hotel' => 'required|integer|exists:hoteles,id',
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no debe exceder 35 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max' => 'Los apellidos no deben exceder 55 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.max' => 'El correo electrónico no debe exceder 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'telefono.max' => 'El teléfono no debe exceder 15 caracteres.',
            'direccion.max' => 'La dirección no debe exceder 255 caracteres.',
            'puesto.required' => 'El puesto es obligatorio.',
            'puesto.max' => 'El puesto no debe exceder 100 caracteres.',
            'turno.required' => 'El turno es obligatorio.',
            'turno.max' => 'El turno no debe exceder 50 caracteres.',
            'hora_entrada.required' => 'La hora de entrada es obligatoria.',
            'hora_entrada.date_format' => 'La hora de entrada debe estar en el formato HH:mm.',
            'hora_salida.required' => 'La hora de salida es obligatoria.',
            'hora_salida.date_format' => 'La hora de salida debe estar en el formato HH:mm.',
            'hora_salida.after' => 'La hora de salida debe ser después de la hora de entrada.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
            'area_asignada.required' => 'El área asignada es obligatoria.',
            'area_asignada.max' => 'El área asignada no debe exceder 100 caracteres.',
            'tarea_asignada.max' => 'La tarea asignada no debe exceder 255 caracteres.',
            'id_hotel.required' => 'El hotel asignado es obligatorio.',
            'id_hotel.integer' => 'El hotel asignado debe ser un número entero.',
            'id_hotel.exists' => 'El hotel asignado no existe en el sistema.',
        ]);
        
        

        User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => $request->password,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'rol' => 2, // trabajador por defecto, admins solo pueden crear admins
            'puesto' => $request->puesto,
            'turno' => $request->turno,
            'hora_entrada' => $request->hora_entrada,
            'hora_salida' => $request->hora_salida,
            'fecha_ingreso' => $request->fecha_ingreso,
            'area_asignada' => $request->area_asignada,
            'tarea_asignada' => $request->tarea_asignada,
            'id_hotel' => $request->id_hotel,
        ]);

        return redirect()->route('personal.index')->with('success', 'Trabajador creado con éxito.');
    }

    /**
     * aditar cliente
     */
    public function editCliente($id)
    {
        $cliente = User::where('rol', 1)->findOrFail($id);
        return view('Cliente.Edit_Cliente', compact('cliente'));
    }

    /**
     * editar trabajador
     */
    public function editPersonal($id)
    {
        $trabajador = User::whereIn('rol', [2, 3])->findOrFail($id);
        return view('Personal.Edit_Personal', compact('trabajador'));
    }

    /**
     * actualizar cliente
     */
    public function updateCliente(Request $request, $id)
{
    $cliente = User::where('rol', 1)->findOrFail($id);

    
    $request->validate([
        'nombre' => 'required|string|max:35',  
        'apellidos' => 'required|string|max:55', 
        'email' => 'required|string|email|max:255|unique:users,email,' . $cliente->id,
        'telefono' => [
            'required',
            'string',
            'max:15',  
            'regex:/^[\+0-9\s\-]*$/',  
        ],  
        'direccion' => 'required|string|max:255',  
    ], [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.string' => 'El campo nombre debe ser una cadena de texto.',
        'nombre.max' => 'El campo nombre no debe exceder los 35 caracteres.',
        
        'apellidos.required' => 'El campo apellidos es obligatorio.',
        'apellidos.string' => 'El campo apellidos debe ser una cadena de texto.',
        'apellidos.max' => 'El campo apellidos no debe exceder los 55 caracteres.',
        
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.string' => 'El campo correo electrónico debe ser una cadena de texto.',
        'email.email' => 'El correo electrónico no tiene un formato válido.',
        'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
        'email.unique' => 'Este correo electrónico ya está registrado.',
        
        'telefono.required' => 'El campo teléfono es obligatorio.',
        'telefono.string' => 'El campo teléfono debe ser una cadena de texto.',
        'telefono.max' => 'El campo teléfono no debe exceder los 15 caracteres.',
        'telefono.regex' => 'El teléfono solo debe contener números, +, espacios y guiones.',
        
        'direccion.required' => 'El campo dirección es obligatorio.',
        'direccion.string' => 'El campo dirección debe ser una cadena de texto.',
        'direccion.max' => 'El campo dirección no debe exceder los 255 caracteres.',
    ]);
    

    $cliente->update([
        'nombre' => $request->nombre,
        'apellidos' => $request->apellidos,
        'email' => $request->email,
        'telefono' => $request->telefono,  
        'direccion' => $request->direccion, 
    ]);

    return redirect()->route('clientes.index')->with('success', 'Cliente actualizado con éxito.');
}


    /**
     * Actualizar trabajador
     */
public function updatePersonal(Request $request, $id)
{
    // uscar al trabajador por Idy asegurarse de que tiene rol 2 o 3
    $trabajador = User::whereIn('rol', [2, 3])->findOrFail($id);

  
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:35', 
        'apellidos' => 'required|string|max:55', 
        'email' => 'required|string|email|max:255|unique:users,email,' . $trabajador->id,
        'telefono' => 'nullable|string|max:15',
        'direccion' => 'nullable|string|max:255',
        'rol' => 'required|in:2,3', 
        'puesto' => 'required|string|max:100', 
        'turno' => 'required|string|max:50', 
        'hora_entrada' => 'required|date_format:H:i', 
        'hora_salida' => 'required|date_format:H:i|after:hora_entrada', 
        'fecha_ingreso' => 'required|date', 
        'area_asignada' => 'required|string|max:100', 
        'tarea_asignada' => 'nullable|string|max:255',
        'estado' => 'required|boolean', 
        'id_hotel' => 'required|exists:hoteles,id',
        'password' => 'nullable|confirmed|min:8', 
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.max' => 'El nombre no debe exceder 35 caracteres.',
        'apellidos.required' => 'Los apellidos son obligatorios.',
        'apellidos.max' => 'Los apellidos no deben exceder 55 caracteres.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'El correo electrónico debe ser válido.',
        'email.max' => 'El correo electrónico no debe exceder 255 caracteres.',
        'email.unique' => 'El correo electrónico ya está registrado.',
        'telefono.max' => 'El teléfono no debe exceder 15 caracteres.',
        'direccion.max' => 'La dirección no debe exceder 255 caracteres.',
        'rol.required' => 'El rol es obligatorio.',
        'rol.in' => 'El rol debe ser 2 (empleado) o 3 (supervisor).',
        'puesto.required' => 'El puesto es obligatorio.',
        'puesto.max' => 'El puesto no debe exceder 100 caracteres.',
        'turno.required' => 'El turno es obligatorio.',
        'turno.max' => 'El turno no debe exceder 50 caracteres.',
        'hora_entrada.required' => 'La hora de entrada es obligatoria.',
        'hora_entrada.date_format' => 'La hora de entrada debe estar en el formato HH:mm.',
        'hora_salida.required' => 'La hora de salida es obligatoria.',
        'hora_salida.date_format' => 'La hora de salida debe estar en el formato HH:mm.',
        'hora_salida.after' => 'La hora de salida debe ser después de la hora de entrada.',
        'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
        'fecha_ingreso.date' => 'La fecha de ingreso debe ser una fecha válida.',
        'area_asignada.required' => 'El área asignada es obligatoria.',
        'area_asignada.max' => 'El área asignada no debe exceder 100 caracteres.',
        'tarea_asignada.max' => 'La tarea asignada no debe exceder 255 caracteres.',
        'estado.required' => 'El estado es obligatorio.',
        'estado.boolean' => 'El estado debe ser verdadero o falso.',
        'id_hotel.required' => 'El hotel asignado es obligatorio.',
        'id_hotel.exists' => 'El hotel asignado no existe en el sistema.',
        'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
    ]);
    

    $trabajador->nombre = $validatedData['nombre'];
    $trabajador->apellidos = $validatedData['apellidos'];
    $trabajador->email = $validatedData['email'];
    $trabajador->telefono = $validatedData['telefono'] ?? null;
    $trabajador->direccion = $validatedData['direccion'] ?? null;
    $trabajador->rol = $validatedData['rol'];
    $trabajador->puesto = $validatedData['puesto'] ?? null;
    $trabajador->turno = $validatedData['turno'] ?? null;
    $trabajador->hora_entrada = $validatedData['hora_entrada'] ?? null;
    $trabajador->hora_salida = $validatedData['hora_salida'] ?? null;
    $trabajador->fecha_ingreso = $validatedData['fecha_ingreso'] ?? null;
    $trabajador->area_asignada = $validatedData['area_asignada'] ?? null;
    $trabajador->tarea_asignada = $validatedData['tarea_asignada'] ?? null;
    $trabajador->estado = $validatedData['estado'];
    $trabajador->id_hotel = $validatedData['id_hotel'];

    
    if (!empty($validatedData['password'])) {
        $trabajador->password = Hash::make($validatedData['password']);
    }
    $trabajador->save();

    return redirect()->route('personal.index')->with('success', 'Trabajador actualizado con éxito.');
}


    /**
     * Eliminar cliente
     */
    public function destroyCliente($id)
    {
        $cliente = User::where('rol', 1)->findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado con éxito.');
    }

    /**
 * Eliminar trabajador soft delete
 */
public function destroyPersonal($id)
{
    $trabajador = User::whereIn('rol', [2, 3])->findOrFail($id);
    $trabajador->update(['estado' => 0]);
    return redirect()->route('personal.index')->with('success', 'Trabajador desactivado con éxito.');
}

//pdfs xd

public function generarPdf(){
}


}