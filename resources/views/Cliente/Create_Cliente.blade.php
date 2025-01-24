@extends('layouts.app')

@section('head.content')
    <title>Crear Cliente</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection

@section('main.content')
    <div class="main-content">
        <h2>Registro de Cliente</h2>
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="35" required aria-label="Campo para ingresar el nombre del cliente">
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos') }}" maxlength="55" required aria-label="Campo para ingresar los apellidos del cliente">
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" maxlength="15" required aria-label="Campo para ingresar el número de teléfono del cliente">
            </div>

            <div class="input-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" maxlength="255" required aria-label="Campo para ingresar la dirección del cliente">
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" maxlength="255" required aria-label="Campo para ingresar el correo electrónico del cliente">
            </div>

            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" minlength="8" required aria-label="Campo para ingresar la contraseña del cliente">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required aria-label="Campo para confirmar la contraseña del cliente">
            </div>

            <div class="button-group">
                <a href="{{ route('clientes.index') }}" class="cancel-button" aria-label="Botón para cancelar el registro de cliente">Cancelar</a>
                <button type="submit" class="cancel-button" aria-label="Botón para registrar al cliente">Registrar</button>
            </div>
        </form>
    </div>

    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            const errorMessages = `{!! implode('<br>', $errors->all()) !!}`;

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessages,
                confirmButtonText: 'Entendido',
                didOpen: () => {
                    const liveRegion = document.createElement('div');
                    liveRegion.setAttribute('aria-live', 'assertive');
                    liveRegion.setAttribute('role', 'alert');
                    liveRegion.setAttribute('aria-label', `Se han encontrado los siguientes errores: ${errorMessages}`);
                    document.body.appendChild(liveRegion);
                }
            });
            narrar(`{!! implode('. ', $errors->all()) !!}`);
        };
    </script>
    @endif

    <script>
        function narrar(texto) {
            window.speechSynthesis.cancel();
            const narrador = new SpeechSynthesisUtterance(texto);
            narrador.lang = 'es-ES';
            
            const vocesDisponibles = window.speechSynthesis.getVoices();
            const vozSeleccionada = vocesDisponibles.find(voz => voz.lang === 'es-ES');
            if (vozSeleccionada) {
                narrador.voice = vozSeleccionada;
            } else {
                console.warn('No se encontró una voz en español. Usando la voz predeterminada.');
            }

            window.speechSynthesis.speak(narrador);
        }

        document.querySelectorAll('[aria-label]').forEach(elemento => {
            elemento.addEventListener('mouseover', () => {
                const descripcion = elemento.getAttribute('aria-label');
                narrar(descripcion);
            });
        });
    </script>
@endsection
