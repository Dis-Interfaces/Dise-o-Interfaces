@extends('layouts.app')
@section('head.content')
    <title>Crear Habitación</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <h2>Nueva Habitación</h2>
    <form action="{{ route('habitaciones.store') }}" method="POST" id="createRoomForm">
        @csrf
        <div class="input-group">
            <label for="hotel_id">Hotel</label>
            <select name="hotel_id" class="form-control" required aria-label="Selecciona un hotel">
                <option value="">Selecciona un hotel</option>
                <option value="1">Hotel Sol</option>
                <option value="2">Hotel Mar</option>
                <option value="3">Hotel Luna</option>
            </select>
        </div>
        <div class="input-group">
            <label for="tipo_habitacion_id">Tipo de Habitación</label>
            <select name="tipo_habitacion_id" class="form-control" required aria-label="Selecciona un tipo de habitación">
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
            <input type="text" name="numero_habitacion" class="form-control" required aria-label="Número de habitación">
        </div>
        <div class="input-group">
            <label for="tarifa">Tarifa</label>
            <input type="number" name="tarifa" class="form-control" step="0.01" required aria-label="Tarifa de la habitación">
        </div>
        <div class="input-group">
            <label for="estado">Estado</label>
            <select name="estado" class="form-control" required aria-label="Selecciona el estado de la habitación">
                <option value="disponible">Disponible</option>
                <option value="ocupada">Ocupada</option>
                <option value="mantenimiento">Mantenimiento</option>
            </select>
        </div>
        <div class="input-group">
            <label for="piso">Piso</label>
            <select name="piso" class="form-control" required aria-label="Selecciona el piso">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.onload = function () {
        const form = document.getElementById('createRoomForm');
        const errors = [];
        let hasError = false;

        // Verificación de los campos del formulario
        const hotelId = form.querySelector('select[name="hotel_id"]');
        const tipoHabitacionId = form.querySelector('select[name="tipo_habitacion_id"]');
        const numeroHabitacion = form.querySelector('input[name="numero_habitacion"]');
        const tarifa = form.querySelector('input[name="tarifa"]');
        const estado = form.querySelector('select[name="estado"]');
        const piso = form.querySelector('select[name="piso"]');

        // Validación: Hotel
        if (!hotelId.value) {
            errors.push({ message: 'El hotel es obligatorio.', icon: 'fa-building' });
            hasError = true;
        }

        // Validación: Tipo de habitación
        if (!tipoHabitacionId.value) {
            errors.push({ message: 'El tipo de habitación es obligatorio.', icon: 'fa-bed' });
            hasError = true;
        }

        // Validación: Número de habitación
        if (!numeroHabitacion.value) {
            errors.push({ message: 'El número de habitación es obligatorio.', icon: 'fa-hotel' });
            hasError = true;
        }

        // Validación: Tarifa
        if (!tarifa.value || tarifa.value <= 0) {
            errors.push({ message: 'La tarifa debe ser mayor a 0.', icon: 'fa-dollar-sign' });
            hasError = true;
        }

        // Validación: Estado
        if (!estado.value) {
            errors.push({ message: 'El estado de la habitación es obligatorio.', icon: 'fa-flag' });
            hasError = true;
        }

        // Validación: Piso
        if (!piso.value) {
            errors.push({ message: 'El piso es obligatorio.', icon: 'fa-building' });
            hasError = true;
        }

        // Si hay errores, mostrar la notificación
        if (hasError) {
            const errorMessages = errors.map(error => `<div><i class="fa ${error.icon}"></i> ${error.message}</div>`).join('');
            <div class="button-group">
                <a href="{{ route('inventario.index') }}" class="cancel-button">Cancelar</a>
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
                html: errorMessages,
                confirmButtonText: 'Entendido'
            });

            const speakErrors = (message) => {
                const utterance = new SpeechSynthesisUtterance(message);
                utterance.lang = 'es-ES'; // Establecer el idioma a español
                window.speechSynthesis.speak(utterance);
            };


            const messageToRead = errors.map(error => error.message).join('. ');
            speakErrors(messageToRead);
        }
    };
</script>

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
