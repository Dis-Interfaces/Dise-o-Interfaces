@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST" class="form-container">
        @csrf
        @method('PUT')
        <h1>Editar Reservación</h1>
        <div class="form-group">
            <label for="id_hotel">Hotel</label>
            <select name="id_hotel" id="id_hotel" required>
                @foreach($hoteles as $hotel)
                <option value="{{ $hotel->id }}" {{ $reservacion->id_hotel == $hotel->id ? 'selected' : '' }}>
                    {{ $hotel->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del Cliente</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $reservacion->nombre) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $reservacion->email) }}" required>
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" value="{{ old('telefono', $reservacion->telefono) }}" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" value="{{ old('direccion', $reservacion->direccion) }}">
        </div>
        <div class="form-group">
            <label for="fecha_reservacion">Fecha de Reservación</label>
            <input type="date" name="fecha_reservacion" id="fecha_reservacion" value="{{ old('fecha_reservacion', $reservacion->fecha_reservacion) }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_entrada">Fecha de Entrada</label>
            <input type="date" name="fecha_entrada" id="fecha_entrada" value="{{ old('fecha_entrada', $reservacion->fecha_entrada) }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_salida">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" value="{{ old('fecha_salida', $reservacion->fecha_salida) }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_reservacion">Tipo de Reservación</label>
            <select name="tipo_reservacion" id="tipo_reservacion" required>
                <option value="individual" {{ $reservacion->tipo_reservacion == 'individual' ? 'selected' : '' }}>Individual</option>
                <option value="grupal" {{ $reservacion->tipo_reservacion == 'grupal' ? 'selected' : '' }}>Grupal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipo_habitacion">Tipo de Habitación</label>
            <select name="tipo_habitacion" id="tipo_habitacion" required>
                @foreach($habitaciones as $habitacion)
                <option value="{{ $habitacion->id }}" {{ $reservacion->tipo_habitacion == $habitacion->id ? 'selected' : '' }}>
                    {{ $habitacion->nombre }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="monto_total">Monto Total</label>
            <input type="number" name="monto_total" id="monto_total" step="0.01" value="{{ old('monto_total', $reservacion->monto_total) }}" required>
        </div>
        <div class="form-group">
            <label for="descuento">Código Promocional</label>
            <input type="text" name="descuento" id="descuento" value="{{ old('descuento', $reservacion->descuento) }}">
        </div>
        <div class="form-group">
            <label for="articulos_adicionales">Artículos Adicionales</label>
            <input type="text" name="articulos_adicionales" id="articulos_adicionales" value="{{ old('articulos_adicionales', $reservacion->articulos_adicionales) }}">
        </div>
        <div class="form-group">
            <label for="notas">Notas</label>
            <textarea name="notas" id="notas">{{ old('notas', $reservacion->notas) }}</textarea>
        </div>
        <div class="form-group">
            <label for="metodo_pago">Método de Pago</label>
            <input type="text" name="metodo_pago" id="metodo_pago" value="{{ old('metodo_pago', $reservacion->metodo_pago) }}" required>
        </div>
        <button type="submit" class="submit-button">Actualizar</button>
    </form>
</div>
@endsection
