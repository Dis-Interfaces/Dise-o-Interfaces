@extends('layouts.app')

@section('head.content')
    <title>Editar Personal</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_form.css') }}">
@endsection

@section('main.content')
    <div class="main-content">
        <h2>Editar Personal</h2>
        <form action="{{ route('personal.update', $trabajador->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input de Nombre -->
            <div class="input-group">
                <label for="nombre">Nombre:</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $trabajador->nombre) }}"
                    required
                    aria-describedby="nombre-error">
                @error('nombre')
                    <span id="nombre-error" class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input de Apellidos -->
            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input
                    type="text"
                    id="apellidos"
                    name="apellidos"
                    value="{{ old('apellidos', $trabajador->apellidos) }}"
                    required
                    aria-describedby="apellidos-error">
                @error('apellidos')
                    <span id="apellidos-error" class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Input de Correo Electrónico -->
            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $trabajador->email) }}"
                    required
                    aria-describedby="email-error">
                @error('email')
                    <span id="email-error" class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Otros campos del formulario -->
            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input
                    type="tel"
                    id="telefono"
                    name="telefono"
                    value="{{ old('telefono', $trabajador->telefono) }}"
                    aria-describedby="telefono-error">
                @error('telefono')
                    <span id="telefono-error" class="error">{{ $message }}</span>
                @enderror
            </div>

            <!-- Continúa con los demás campos similares -->

            <div class="button-group">
                <a href="{{ route('personal.index') }}" class="cancel-button">Cancelar</a>
                <button type="submit" class="submit-button">Guardar Cambios</button>
            </div>
        </form>
    </div>

    <!-- Mensajes de sesión -->
    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Entendido',
                timer: 3000
            });
        </script>
    @endif

    <!-- Notificaciones de errores -->
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.onload = function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Errores encontrados',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Entendido'
                });
            };
        </script>
    @endif

    <!-- Narrador accesible para lectores de pantalla -->
    @if (session('success') || $errors->any())
        <div role="alert" aria-live="assertive" class="visually-hidden">
            @if (session('success'))
                {{ session('success') }}
            @endif

            @if ($errors->any())
                {!! implode(' ', $errors->all()) !!}
            @endif
        </div>
    @endif
@endsection
