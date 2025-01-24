@extends('layouts.app')

@section('head.content')
    <title>Crear Promoción</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_form.css') }}">
@endsection

@section('main.content')
<main class="main-content">
    <h2>Crear Promoción</h2>

    <form action="{{ route('promociones.store') }}" method="POST" class="edit-form">
        @csrf

        <div class="input-group">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div class="input-group">
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ old('descripcion') }}" required>
        </div>

        <div class="input-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" required>
                <option value="Descuento" {{ old('tipo') == 'Descuento' ? 'selected' : '' }}>Descuento</option>
                <option value="2x1" {{ old('tipo') == '2x1' ? 'selected' : '' }}>2x1</option>
                <option value="Cashback" {{ old('tipo') == 'Cashback' ? 'selected' : '' }}>Cashback</option>
                <option value="Envío gratis" {{ old('tipo') == 'Envío gratis' ? 'selected' : '' }}>Envío gratis</option>
                <option value="Otro" {{ old('tipo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="input-group">
            <label for="codigo_promocional">Código Promocional</label>
            <input type="text" id="codigo_promocional" name="codigo_promocional" value="{{ old('codigo_promocional') }}" required>
        </div>

        <div class="input-group">
            <label for="descuento">Descuento (opcional)</label>
            <input type="number" id="descuento" name="descuento" value="{{ old('descuento') }}" step="0.01">
        </div>

        <div class="input-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
        </div>

        <div class="input-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required>
        </div>

        <div class="input-group">
            <label for="activo">Activo</label>
            <select name="activo" id="activo" required>
                <option value="1" {{ old('activo') == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('activo') == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="button-group">
            <a href="{{ route('promociones.index') }}" class="cancel-button">Cancelar</a>
            <button class="cancel-button" type="submit">Crear Promoción</button>
        </div>
    </form>

    {{-- Notificaciones de error --}}
    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            const errorMessage = `{!! implode('<br>', $errors->all()) !!}`;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessage,
                confirmButtonText: 'Entendido'
            });
            speakNotification('Error: ' + `{!! implode('. ', $errors->all()) !!}`);
        };

        // Narrador de notificaciones
        function speakNotification(message) {
            const speech = new SpeechSynthesisUtterance(message);
            speech.lang = 'es-MX';
            window.speechSynthesis.speak(speech);
        }
    </script>
    @endif

    {{-- Notificación de éxito --}}
    @if (session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            const successMessage = `{!! session('success') !!}`;
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage,
                confirmButtonText: 'OK'
            });
            speakNotification('Éxito: ' + successMessage);
        };

        function speakNotification(message) {
            const speech = new SpeechSynthesisUtterance(message);
            speech.lang = 'es-MX';
            window.speechSynthesis.speak(speech);
        }
    </script>
    @endif
</main>
@endsection

@section('sidebar.content')
    <ul>
        <li class="sidebar-content"><a href="#">Promociones Activas</a></li>
        <li class="sidebar-content"><a href="#">Promociones Expiradas</a></li>
    </ul>
@endsection
