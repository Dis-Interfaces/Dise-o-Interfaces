<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="{{ asset('/css/habitacion.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="{{ asset('/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
      .nav-links .active a {
            color:rgb(181, 205, 231);
            font-weight: bold;
            text-decoration: underline;
        }
</style>
<body>
    <!-- Barra de Navegación -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-image" aria-label="Logo de la aplicación HUPV">
                HUPV
            </div>
            <ul class="nav-links">
                <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                    <a href="{{ route('index') }}" aria-label="Ir a la página de inicio">Home</a>
                </li>
                <li class="{{ request()->routeIs('habitacion2') ? 'active' : '' }}"> 
                    <a href="{{ route('hotel') }}" aria-label="Ver la lista de hoteles">Hoteles</a>
                </li>
                <li class="{{ request()->routeIs('contacto') ? 'active' : '' }}">
                    <a href="{{ route('contacto') }}" aria-label="Contactar con nosotros">Contacto</a>
                </li>
                <li class="{{ request()->routeIs('login') ? 'active' : '' }}">
                    <a href="{{ route('login') }}" aria-label="Iniciar sesión en su cuenta">Login</a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-label="Cerrar sesión">
                        Logout
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </nav>
    </header>

    <!-- Sección de Habitaciones -->
    <section id="rooms" class="rooms">
    <div class="section-title">
        <h2>Hotel Mar</h2>
    </div>
    <div class="room-booking-container">
        <div class="room-grid">
            <!-- Habitaciones -->
            <div class="room">
                <div class="room-image" style="background-image: url('img/h2.jpg');">
                </div>
                <h1 id="room-type-label" style="padding-top: 30px; font-size:32px" aria-label="Seleccione un tipo">Seleccione un tipo</h1>
            </div>
        </div>
        <div id="booking-form">
            <div class="booking-container">
                <h2>Reservar Habitación</h2>
                <form action="{{ route('reservaciones.store2') }}" method="POST" onsubmit="handleFormSubmit(event)">
                    @csrf
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="nombre" aria-label="Nombre del Cliente">Nombre del Cliente</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" oninput="narrateInput('nombre')" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono" aria-label="Teléfono">Teléfono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control" oninput="narrateInput('telefono')" required>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="direccion" aria-label="Dirección">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" oninput="narrateInput('direccion')" required>
                        </div>
                        <div class="form-group">
                            <label for="email" aria-label="Correo Electrónico">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" oninput="narrateInput('email')" required>
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="hotel_id" aria-label="Seleccione un hotel">Hotel:</label>
                            <select id="hotel_id" name="hotel_id" class="form-control" onchange="narrateSelectInput('hotel_id')" required>
                                <option value="2">Hotel Mar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_habitacion_id" aria-label="Seleccione el tipo de habitación">Tipo de Habitación:</label>
                            <select id="tipo_habitacion_id" name="tipo_habitacion_id" class="form-control" onchange="updateRoomTypeLabel(); narrateSelectInput('tipo_habitacion_id')" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="1">Individual</option>
                                <option value="2">Doble</option>
                                <option value="3">Suite</option>
                                <option value="4">Suite Presidencial</option>
                                <option value="5">Familiar</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="fecha_entrada" aria-label="Fecha de Entrada">Fecha de Entrada</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" oninput="narrateInput('fecha_entrada')" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_salida" aria-label="Fecha de Salida">Fecha de Salida</label>
                            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" oninput="narrateInput('fecha_salida')" required>
                        </div>
                    </div>
                    <div id="inventario"></div>
                    <div id="habitaciones"></div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="codigo_promocional" aria-label="Cupón Promocional">Cupón Promocional</label>
                            <input type="text" name="codigo_promocional" id="codigo_promocional" class="form-control" oninput="narrateInput('codigo_promocional')">
                        </div>
                        <div class="form-group">
                            <label for="notas" aria-label="Notas">Notas</label>
                            <textarea name="notas" id="notas" class="form-control" oninput="narrateInput('notas')"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style="width: 100%; padding-top: 30px;">
                        <button type="submit" class="btn btn-primary btn-large" style="width: 100%; height: 50px; font-size: 32px;" aria-label="Confirmar reserva">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
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
</section>

<script>
// Función para narrar las descripciones de los campos cuando se pasa el mouse
document.querySelectorAll('[aria-label]').forEach(elemento => {
    elemento.addEventListener('mouseover', () => {
        const descripcion = elemento.getAttribute('aria-label');
        const msg = new SpeechSynthesisUtterance(descripcion);
        msg.lang = 'es-ES';  // Idioma español
        window.speechSynthesis.speak(msg);
    });
});

// Función para narrar los valores de los campos cuando se escriben
document.querySelectorAll('input, textarea, select').forEach(input => {
    input.addEventListener('input', () => {
        const textoIngresado = input.value;
        const msg = new SpeechSynthesisUtterance(textoIngresado);
        msg.lang = 'es-ES';  // Idioma español
        window.speechSynthesis.speak(msg);
    });
});

// Función para narrar el contenido de los campos de texto al ser editados
function narrateInput(inputId) {
    const inputElement = document.getElementById(inputId);
    const inputValue = inputElement.value;
    const label = inputElement.previousElementSibling ? inputElement.previousElementSibling.textContent : '';

    const msg = new SpeechSynthesisUtterance(`Has escrito: ${label} ${inputValue}`);
    msg.lang = 'es-ES';  
    window.speechSynthesis.speak(msg);
}

// Función para narrar las opciones seleccionadas
function narrateSelectInput(selectId) {
    const selectElement = document.getElementById(selectId);
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const selectedValue = selectedOption.textContent;

    const msg = new SpeechSynthesisUtterance(`Has seleccionado: ${selectedValue}`);
    msg.lang = 'es-ES';  
    window.speechSynthesis.speak(msg);
}
</script>
