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
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" maxlength="35" required aria-label="Campo para editar el nombre del cliente">
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $cliente->apellidos) }}" maxlength="55" required aria-label="Campo para editar los apellidos del cliente">
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" maxlength="15" required aria-label="Campo para editar el teléfono del cliente">
            </div>

            <div class="input-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $cliente->direccion) }}" maxlength="15" required aria-label="Campo para editar la dirección del cliente">
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}" maxlength="255" required aria-label="Campo para editar el correo electrónico del cliente">
            </div>

            <div class="button-group">
                <a href="{{ route('clientes.index') }}" class="cancel-button" aria-label="Botón para cancelar la edición del cliente">Cancelar</a>
                <button type="submit" class="cancel-button" aria-label="Botón para guardar los cambios del cliente">Guardar Cambios</button>
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
