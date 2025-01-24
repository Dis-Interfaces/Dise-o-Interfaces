@extends('layouts.app')

@section('head.content')
    <title>Editar Habitación</title>
    <link rel="stylesheet" href="{{ asset('/css/edit_form.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <h2>Editar Habitación</h2>
    <form action="{{ route('habitaciones.update', $habitacion->id) }}" method="POST" id="editRoomForm">
        @csrf
        @method('PUT')
        <div class="input-group">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" class="form-control" required>
                <option value="1" {{ $habitacion->hotel_id == 1 ? 'selected' : '' }}>Hotel Sol</option>
                <option value="2" {{ $habitacion->hotel_id == 2 ? 'selected' : '' }}>Hotel Mar</option>
                <option value="3" {{ $habitacion->hotel_id == 3 ? 'selected' : '' }}>Hotel Luna</option>
            </select>
        </div>
        <div class="input-group">
            <label for="tipo_habitacion_id">Tipo de Habitación</label>
            <select name="tipo_habitacion_id" class="form-control" required>
                <option value="1" {{ $habitacion->tipo_habitacion_id == 1 ? 'selected' : '' }}>Suite</option>
                <option value="2" {{ $habitacion->tipo_habitacion_id == 2 ? 'selected' : '' }}>Suite de Lujo</option>
                <option value="3" {{ $habitacion->tipo_habitacion_id == 3 ? 'selected' : '' }}>Sencilla</option>
                <option value="4" {{ $habitacion->tipo_habitacion_id == 4 ? 'selected' : '' }}>Habitación con 4 camas</option>
                <option value="5" {{ $habitacion->tipo_habitacion_id == 5 ? 'selected' : '' }}>Habitación con 5 camas</option>
            </select>
        </div>
        <div class="input-group">
            <label for="numero_habitacion">Número de Habitación</label>
            <input type="text" name="numero_habitacion" class="form-control" value="{{ $habitacion->numero_habitacion }}" required>
            <input type="hidden" name="original_numero_habitacion" value="{{ $habitacion->numero_habitacion }}">
        </div>
        <div class="input-group">
            <label for="tarifa">Tarifa</label>
            <input type="number" name="tarifa" class="form-control" step="0.01" value="{{ $habitacion->tarifa }}" required>
        </div>
        <div class="input-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required>
                <option value="disponible" {{ $habitacion->estado == 'disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="ocupada" {{ $habitacion->estado == 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                <option value="mantenimiento" {{ $habitacion->estado == 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
            </select>
        </div>
        <div class="input-group">
            <label for="piso">Piso</label>
            <select name="piso" class="form-control" required>
                <option value="1" {{ $habitacion->piso == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $habitacion->piso == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $habitacion->piso == 3 ? 'selected' : '' }}>3</option>
            </select>
        </div>

        <div class="button-group">
            <a href="{{ route('habitaciones.index') }}" class="cancel-button">Cancelar</a>
            <button type="submit" class="cancel-button">Guardar Cambios</button>
        </div>

    </form>
</div>

@if ($errors->any())
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = function () {
        const form = document.getElementById('editRoomForm');
        const errors = [];
        let hasError = false;

        // Validación: Hotel
        const hotelId = form.querySelector('select[name="hotel_id"]');
        if (!hotelId.value) {
            errors.push({ message: 'El hotel es obligatorio.', icon: 'fa-building' });
            hasError = true;
        }

        // Validación: Tipo de habitación
        const tipoHabitacionId = form.querySelector('select[name="tipo_habitacion_id"]');
        if (!tipoHabitacionId.value) {
            errors.push({ message: 'El tipo de habitación es obligatorio.', icon: 'fa-bed' });
            hasError = true;
        }

        // Validación: Número de habitación
        const numeroHabitacion = form.querySelector('input[name="numero_habitacion"]');
        if (!numeroHabitacion.value) {
            errors.push({ message: 'El número de habitación es obligatorio.', icon: 'fa-hotel' });
            hasError = true;
        }

        // Validación: Tarifa
        const tarifa = form.querySelector('input[name="tarifa"]');
        if (!tarifa.value || tarifa.value <= 0) {
            errors.push({ message: 'La tarifa debe ser mayor a 0.', icon: 'fa-dollar-sign' });
            hasError = true;
        }

        // Validación: Estado
        const estado = form.querySelector('select[name="estado"]');
        if (!estado.value) {
            errors.push({ message: 'El estado de la habitación es obligatorio.', icon: 'fa-flag' });
            hasError = true;
        }

        // Validación: Piso
        const piso = form.querySelector('select[name="piso"]');
        if (!piso.value) {
            errors.push({ message: 'El piso es obligatorio.', icon: 'fa-building' });
            hasError = true;
        }

        // Si hay errores, mostrar la notificación
        if (hasError) {
            const errorMessages = errors.map(error => `<div><i class="fa ${error.icon}"></i> ${error.message}</div>`).join('');
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: errorMessages,
                confirmButtonText: 'Entendido'
            });

            // Función para narrar los errores
            const speakErrors = (message) => {
                const utterance = new SpeechSynthesisUtterance(message);
                utterance.lang = 'es-ES'; // Establecer el idioma a español
                window.speechSynthesis.speak(utterance);
            };

            // Narrar los errores si existen
            const messageToRead = errors.map(error => error.message).join('. ');
            speakErrors(messageToRead);
        }
    };
</script>
@endif

@endsection
@section('sidebar.content')
    <div class="sidebar-content" class="active">
        <a href="{{ route('inventario.index') }}">
                Stock
        </a>
    </div>

    <div class="sidebar-content">
    <a href="{{ route('ordenes-compra.index') }}">
        Ordenes
        </a>
    </div>    
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

    document.querySelectorAll('input, select').forEach(function(element) {
        element.addEventListener('input', function() {
            narrar(`Ingresando: ${this.value}`);
        });
    });
</script>
@endsection
