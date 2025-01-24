@extends('layouts.app')

@section('head.content')
    <title>Registrar Personal</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection

@section('main.content')
    <div class="main-content">
        <h2>Registro de Personal</h2>

        <form action="{{ route('personal.store') }}" method="POST" id="personalForm">
            @csrf

            <div class="input-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}">
            </div>

            <div class="input-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" required value="{{ old('apellidos') }}">
            </div>

            <div class="input-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="input-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" value="{{ old('telefono') }}">
            </div>

            <div class="input-group">
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}">
            </div>

            <div class="input-group">
                <label for="puesto">Puesto:</label>
                <input type="text" id="puesto" name="puesto" required value="{{ old('puesto') }}">
            </div>

            <div class="input-group">
                <label for="turno">Turno:</label>
                <select id="turno" name="turno" required>
                    <option value="Mañana" {{ old('turno') == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                    <option value="Tarde" {{ old('turno') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                    <option value="Noche" {{ old('turno') == 'Noche' ? 'selected' : '' }}>Noche</option>
                </select>
            </div>

            <div class="input-group">
                <label for="hora_entrada">Hora de Entrada:</label>
                <input type="time" id="hora_entrada" name="hora_entrada" required value="{{ old('hora_entrada') }}">
            </div>

            <div class="input-group">
                <label for="hora_salida">Hora de Salida:</label>
                <input type="time" id="hora_salida" name="hora_salida" required value="{{ old('hora_salida') }}">
            </div>

            <div class="input-group">
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required value="{{ old('fecha_ingreso') }}">
            </div>

            <div class="input-group">
                <label for="area_asignada">Área Asignada:</label>
                <input type="text" id="area_asignada" name="area_asignada" required value="{{ old('area_asignada') }}">
            </div>

            <div class="input-group">
                <label for="tarea_asignada">Tarea Asignada:</label>
                <input type="text" id="tarea_asignada" name="tarea_asignada" required value="{{ old('tarea_asignada') }}">
            </div>

            <div class="input-group">
                <label for="id_hotel">Hotel:</label>
                <select id="id_hotel" name="id_hotel" required>
                    <option value="1" {{ old('id_hotel') == 1 ? 'selected' : '' }}>Hotel Sol</option>
                    <option value="2" {{ old('id_hotel') == 2 ? 'selected' : '' }}>Hotel Luna</option>
                    <option value="3" {{ old('id_hotel') == 3 ? 'selected' : '' }}>Hotel Estrella</option>
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('personal.index') }}" class="cancel-button" id="cancelButton">Cancelar</a>
                <button type="submit" class="register-button" id="registerButton">Registrar</button>
            </div>
        </form>
    </div>

    {{-- SweetAlert2 Notifications --}}
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            window.onload = function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de validación',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonText: 'Entendido',
                    willOpen: () => {
                        const narrator = new SpeechSynthesisUtterance('Se encontraron errores en el formulario. Por favor corrige los campos marcados.');
                        window.speechSynthesis.speak(narrator);
                    }
                });
            };
        </script>
    @endif

    {{-- Success notification --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonText: 'Perfecto',
                willOpen: () => {
                    const narrator = new SpeechSynthesisUtterance('El personal ha sido registrado correctamente.');
                    window.speechSynthesis.speak(narrator);
                }
            });
        </script>
    @endif

    {{-- Cancel confirmation --}}
    <script>
        document.getElementById('cancelButton').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "Si cancelas, perderás todos los datos ingresados.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, continuar',
                willOpen: () => {
                    const narrator = new SpeechSynthesisUtterance('¿Estás seguro de que deseas cancelar? Perderás todos los datos ingresados.');
                    window.speechSynthesis.speak(narrator);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('personal.index') }}";
                };
            });
        });
    </script>
@endsection
