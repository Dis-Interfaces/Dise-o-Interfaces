@extends('layouts.app')
@section('head.content')
    <title>Crear Habitación</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <h2>Nueva Habitación</h2>
    <form action="{{ route('habitaciones.store') }}" method="POST">
        @csrf
        <div class="input-group">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" class="form-control" required>
                <option value="">Selecciona un hotel</option>
                <option value="1">Hotel Sol</option>
                <option value="2">Hotel Mar</option>
                <option value="3">Hotel Luna</option>
            </select>
        </div>
        <div class="input-group">
            <label for="tipo_habitacion_id">Tipo de Habitación</label>
            <select name="tipo_habitacion_id" class="form-control" required>
                <option value="">Selecciona un tipo</option>
                <option value="1">Suite</option>
                <option value="2">Suite de Lujo</option>
                <option value="3">Sencilla</option>
                <option value="4">Habitación con 4 camas</option>
                <option value="5">Habitación con 5 camas</option>
            </select>
        </div>
        <div class="input-group">
            <label for="numero_habitacion">Número de Habitación</label>
            <input type="text" name="numero_habitacion" class="form-control" required>
        </div>
        <div class="input-group">
            <label for="tarifa">Tarifa</label>
            <input type="number" name="tarifa" class="form-control" step="0.01" required>
        </div>
        <div class="input-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible">Disponible</option>
                <option value="ocupada">Ocupada</option>
                <option value="mantenimiento">Mantenimiento</option>
            </select>
        </div>
        <div class="input-group">
            <label for="piso">Piso</label>
            <select name="piso" class="form-control" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="button-group">
            <a href="{{ route('habitaciones.index') }}" class="cancel-button">Cancelar</a>
            <button type="submit" class="cancel-button">Registrar</button>
        </div>

    </form>
</div>

@if ($errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = function () {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonText: 'Entendido'
        });
    };
</script>
@endif

@endsection