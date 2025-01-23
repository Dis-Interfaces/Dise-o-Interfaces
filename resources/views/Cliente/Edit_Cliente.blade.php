@extends('layouts.app')

@section('head.content')
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_form.css') }}">
@endsection

@section('main.content')
    <div class="main-content">
        <h2>Editar Cliente</h2>
        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="input-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" maxlength="35" required>
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" maxlength="55" required>
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" maxlength="15" required>
            </div>

            <div class="input-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" maxlength="15" required>
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}" maxlength="255" required>
            </div>

            <div class="button-group">
                <a href="{{ route('clientes.index') }}" class="cancel-button">Cancelar</a>
                <button type="submit" class="cancel-button">Guardar Cambios</button>
            </div>

        </form>
    </div>

    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            // Creamos el contenido de la notificación con los errores
            const errorMessages = `{!! implode('<br>', $errors->all()) !!}`;

            // Mostramos la notificación de error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessages,  // Incluye los errores en el mensaje
                confirmButtonText: 'Entendido',
                didOpen: () => {
                    const liveRegion = document.createElement('div');
                    liveRegion.setAttribute('aria-live', 'assertive');
                    liveRegion.setAttribute('role', 'alert');
                    liveRegion.setAttribute('aria-label', `Se han encontrado los siguientes errores: ${errorMessages}`);
                    document.body.appendChild(liveRegion);
                }
            });
        };
    </script>
    @endif

@endsection
