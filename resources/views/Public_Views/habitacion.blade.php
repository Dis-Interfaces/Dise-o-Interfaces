<!DOCTYPE html>
<html lang="en">
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
                <li class="{{ request()->routeIs('habitacion') ? 'active' : '' }}"> 
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
        <h2>Hotel Sol</h2>
    </div>
    <div class="room-booking-container">
        <div class="room-grid">
            <!-- Habitaciones -->
            <div class="room">
                <div class="room-image" style="background-image: url('img/h2.jpg');" aria-label="Imagen de la habitación">
                </div>
                <h1 id="room-type-label" style="padding-top: 30px; font-size:32px" aria-label="Etiqueta para el tipo de habitación">Seleccione un tipo</h1>
            </div>                                 
        </div>
        <div id="booking-form">
            <div class="booking-container">
                <h2>Reservar Habitación</h2>
                <form action="{{ route('reservaciones.store2') }}" method="POST" onsubmit="handleFormSubmit(event)">
                    @csrf
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="nombre">Nombre del Cliente</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required aria-label="Campo para ingresar el nombre del cliente" pattern="[A-Za-zÁ-ÿ ]+" title="Solo se permiten letras y espacios">
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="tel" name="telefono" id="telefono" class="form-control" required aria-label="Campo para ingresar el número de teléfono" pattern="^\+?\d{1,4}?[.-\s]?\(?\d{1,3}\)?[.-\s]?\d{1,3}[.-\s]?\d{1,4}$" title="Por favor ingresa un número de teléfono válido, por ejemplo: +123 456 7890">
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" required aria-label="Campo para ingresar la dirección" pattern="[A-Za-z0-9Á-ÿ\s,.-]+" title="Solo se permiten letras, números y algunos caracteres especiales como coma, punto y guión">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" required aria-label="Campo para ingresar el correo electrónico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor ingresa un correo electrónico válido">
                        </div>
                    </div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="hotel_id">Hotel:</label>
                            <select id="hotel_id" name="hotel_id" class="form-control" required aria-label="Seleccionar hotel">
                                <option value="1">Hotel Sol</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipo_habitacion_id">Tipo de Habitación:</label>
                            <select id="tipo_habitacion_id" name="tipo_habitacion_id" class="form-control" onchange="updateRoomTypeLabel()" required aria-label="Seleccionar tipo de habitación">
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
                            <label for="fecha_entrada">Fecha de Entrada</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" required aria-label="Seleccionar fecha de entrada">
                        </div>
                        <div class="form-group">
                            <label for="fecha_salida">Fecha de Salida</label>
                            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required aria-label="Seleccionar fecha de salida">
                        </div>
                    </div>
                    <div id="inventario"></div>
                    <div id="habitaciones"></div>
                    <div class="form-group-row">
                        <div class="form-group">
                            <label for="codigo_promocional">Cupón Promocional</label>
                            <input type="text" name="codigo_promocional" id="codigo_promocional" class="form-control" aria-label="Ingresar cupón promocional" pattern="[A-Za-z0-9]+" title="Solo se permiten letras y números">
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas</label>
                            <textarea name="notas" id="notas" class="form-control" aria-label="Ingresar notas adicionales"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style="width: 100%; padding-top: 30px;">
                        <button type="submit" class="btn btn-primary btn-large" style="width: 100%; height: 50px; font-size: 32px;" aria-label="Botón para reservar habitación">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


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

            document.querySelectorAll('input, textarea, select').forEach(input => {
                input.addEventListener('input', () => {
                    const textoIngresado = input.value;
                    narrar(textoIngresado);
                });
            });
        </script>

        <script>
            function narrateInput(inputId) {
                const inputElement = document.getElementById(inputId);
                const value = inputElement.value;
                
                const utterance = new SpeechSynthesisUtterance(value);
                speechSynthesis.speak(utterance);
            }

        </script>
    </section>
</body>
</html>
