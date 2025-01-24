@extends('layouts.app')

@section('head.content')
    <title>Registrar Personal</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection

@section('main.content')
    <div class="main-content">
        <h2>Registro de Personal</h2>

        <form action="{{ route('personal.store') }}" method="POST">
            @csrf

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
                <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}" aria-label="Ingrese el nombre del personal">
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required value="{{ old('apellidos') }}" aria-label="Ingrese los apellidos del personal">
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}" aria-label="Ingrese el correo electrónico del personal">
            </div>

            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required aria-label="Ingrese una contraseña">
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required aria-label="Confirme la contraseña">
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}" aria-label="Ingrese el número de teléfono">
            </div>

            <div class="input-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" aria-label="Ingrese la dirección del personal">
            </div>

            <div class="input-group">
                <label for="puesto">Puesto:</label>
                <input type="text" id="puesto" name="puesto" required value="{{ old('puesto') }}" aria-label="Ingrese el puesto del personal">
            </div>

            <div class="input-group">
                <label for="turno">Turno:</label>
                <select id="turno" name="turno" required aria-label="Seleccione el turno del personal">
                    <option value="Mañana" {{ old('turno') == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="Tarde" {{ old('turno') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                    <option value="Noche" {{ old('turno') == 'Noche' ? 'selected' : '' }}>Noche</option>
                </select>
            </div>

            <div class="input-group">
                <label for="hora_entrada">Hora de Entrada:</label>
                <input type="time" id="hora_entrada" name="hora_entrada" required value="{{ old('hora_entrada') }}" aria-label="Seleccione la hora de entrada">
            </div>

            <div class="input-group">
                <label for="hora_salida">Hora de Salida:</label>
                <input type="time" id="hora_salida" name="hora_salida" required value="{{ old('hora_salida') }}" aria-label="Seleccione la hora de salida">
            </div>

            <div class="input-group">
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required value="{{ old('fecha_ingreso') }}" aria-label="Seleccione la fecha de ingreso">
            </div>

            <div class="input-group">
                <label for="area_asignada">Área Asignada:</label>
                <input type="text" id="area_asignada" name="area_asignada" required value="{{ old('area_asignada') }}" aria-label="Ingrese el área asignada">
            </div>

            <div class="input-group">
                <label for="tarea_asignada">Tarea Asignada:</label>
                <input type="text" id="tarea_asignada" name="tarea_asignada" required value="{{ old('tarea_asignada') }}" aria-label="Ingrese la tarea asignada">
            </div>

            <div class="input-group">
                <label for="id_hotel">Hotel:</label>
                <select id="id_hotel" name="id_hotel" required aria-label="Seleccione el hotel">
                    <option value="1" {{ old('id_hotel') == 1 ? 'selected' : '' }}>Hotel Sol</option>
                    <option value="2" {{ old('id_hotel') == 2 ? 'selected' : '' }}>Hotel Luna</option>
                    <option value="3" {{ old('id_hotel') == 3 ? 'selected' : '' }}>Hotel Estrella</option>
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('personal.index') }}" class="cancel-button">Cancelar</a>
                <button type="submit" class="cancel-button">Registrar</button>
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

@section('scripts')
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

    document.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', () => {
            const textoIngresado = input.value;
            narrar(textoIngresado);
        });
    });
</script>
@endsection
