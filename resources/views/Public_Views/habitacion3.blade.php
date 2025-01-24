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
                <li class="{{ request()->routeIs('habitacion3') ? 'active' : '' }}"> 
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
            <h2>Hotel Luna</h2>
        </div>
        <div class="room-booking-container">
            <div class="room-grid">
                <!-- Habitaciones -->
                <div class="room">
                    <div class="room-image" style="background-image: url('img/h2.jpg');"></div>
                    <h1 id="room-type-label" style="padding-top: 30px; font-size:32px">Seleccione un tipo</h1>
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
                                <input type="text" name="nombre" id="nombre" class="form-control" required onfocus="narrarEntrada('Por favor ingrese su nombre')">
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" required onfocus="narrarEntrada('Por favor ingrese su número de teléfono')">
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" required onfocus="narrarEntrada('Por favor ingrese su dirección')">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" name="email" id="email" class="form-control" required onfocus="narrarEntrada('Por favor ingrese su correo electrónico')">
                            </div>
                        </div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="hotel_id">Hotel:</label>
                                <select id="hotel_id" name="hotel_id" class="form-control" required onfocus="narrarEntrada('Seleccione el hotel de su preferencia')">
                                    <option value="3">Hotel Luna</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tipo_habitacion_id">Tipo de Habitación:</label>
                                <select id="tipo_habitacion_id" name="tipo_habitacion_id" class="form-control" onchange="updateRoomTypeLabel()" required onfocus="narrarEntrada('Seleccione el tipo de habitación')">
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
                                <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" required onfocus="narrarEntrada('Seleccione la fecha de entrada')">
                            </div>
                            <div class="form-group">
                                <label for="fecha_salida">Fecha de Salida</label>
                                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required onfocus="narrarEntrada('Seleccione la fecha de salida')">
                            </div>
                        </div>
                        <div id="inventario"></div>
                        <div id="habitaciones"></div>
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="codigo_promocional">Cupón Promocional</label>
                                <input type="text" name="codigo_promocional" id="codigo_promocional" class="form-control" onfocus="narrarEntrada('Si tiene un cupón promocional, ingréselo aquí')">
                            </div>
                            <div class="form-group">
                                <label for="notas">Notas</label>
                                <textarea name="notas" id="notas" class="form-control" onfocus="narrarEntrada('Si tiene alguna nota adicional, ingrésela aquí')"></textarea>
                            </div>
                        </div>
                        <div class="form-group" style="width: 100%; padding-top: 30px;">
                            <button type="submit" class="btn btn-primary btn-large" style="width: 100%; height: 50px; font-size: 32px;">Reservar</button>
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


<script>
    let isSpeaking = false;

    document.querySelectorAll('[aria-label]').forEach(elemento => {
        elemento.addEventListener('mouseover', () => {
            if (isSpeaking) return;  
            const descripcion = elemento.getAttribute('aria-label');
            
            if (descripcion.trim()) {
                narrarEntrada(descripcion);
            }
        });
    });

    function narrarEntrada(texto) {
        if (!window.speechSynthesis) {
            console.error('El narrador no es compatible con este navegador.');
            return;
        }

        window.speechSynthesis.cancel();

        const synth = window.speechSynthesis;
        const utterance = new SpeechSynthesisUtterance(texto);

        utterance.lang = 'es-ES';
        utterance.rate = 1;
        utterance.pitch = 1;

        utterance.onstart = () => {
            isSpeaking = true;
        };

        utterance.onend = () => {
            isSpeaking = false;
        };

        utterance.onerror = (event) => {
            console.error('Error en la narración:', event.error);
            isSpeaking = false;
        };

        synth.speak(utterance);
    }

    function fetchOptions() {
        const hotelId = document.getElementById('hotel_id').value;
        const tipoHabitacionId = document.getElementById('tipo_habitacion_id').value;

        fetch(`/api/filtrar-datos?hotel_id=${hotelId}&tipo_habitacion_id=${tipoHabitacionId}`)
            .then(response => response.json())
            .then(data => {
                const habitacionesSelect = document.getElementById('habitaciones');
                habitacionesSelect.innerHTML = '';
                if (data.habitaciones.length === 0) {
                    habitacionesSelect.innerHTML = '<option value="">No hay habitaciones disponibles</option>';
                } else {
                    data.habitaciones.forEach(habitacion => {
                        habitacionesSelect.innerHTML += `<option value="${habitacion.id}">${habitacion.numero_habitacion}</option>`;
                    });
                }

                const inventarioDiv = document.getElementById('inventario');
                inventarioDiv.innerHTML = '';
                data.inventario.forEach(item => {
                    inventarioDiv.innerHTML += `
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">${item.nombre_producto}</label>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="updateQuantity(${item.id_producto}, -1)">-</button>
                            <input type="number" id="cantidad_${item.id_producto}" value="0" min="0" class="form-control mx-2 text-center" style="width: 60px;" readonly>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="updateQuantity(${item.id_producto}, 1)">+</button>
                        </div>`;
                });
            })
            .catch(error => {
                console.error('Error al obtener los datos:', error);
            });
    }

    function updateQuantity(productId, change) {
        const cantidadInput = document.getElementById(`cantidad_${productId}`);
        let cantidad = parseInt(cantidadInput.value);

        cantidad = Math.max(0, cantidad + change);
        cantidadInput.value = cantidad;

        fetch(`/api/actualizar-inventario`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_producto: productId,
                cantidad: cantidad
            }),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Inventario actualizado:', data);
        })
        .catch(error => {
            console.error('Error al actualizar el inventario:', error);
        });
    }

    function updateRoomTypeLabel() {
        var select = document.getElementById("tipo_habitacion_id");
        var label = select.options[select.selectedIndex].text;
        document.getElementById("room-type-label").innerText = label;
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        const form = event.target;
        const hotelId = document.getElementById('hotel_id').value;
        const tipoHabitacionId = document.getElementById('tipo_habitacion_id').value;

        fetch(`/api/habitaciones-inventario?hotel_id=${hotelId}&tipo_habitacion_id=${tipoHabitacionId}`)
            .then(response => response.json())
            .then(data => {
                const inventarioDiv = document.getElementById('inventario');
                inventarioDiv.innerHTML = '';
                data.inventario.forEach(item => {
                    inventarioDiv.innerHTML += `<input type="hidden" name="inventario[${item.id_producto}][id]" value="${item.id_producto}">`;
                    inventarioDiv.innerHTML += `<input type="hidden" name="inventario[${item.id_producto}][cantidad]" value="1">`;
                });

                const habitacionesDiv = document.getElementById('habitaciones');
                habitacionesDiv.innerHTML = '';
                if (data.habitaciones.length === 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No hay habitaciones disponibles para el tipo seleccionado.',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                }
                data.habitaciones.forEach(habitacion => {
                    habitacionesDiv.innerHTML += `<input type="hidden" name="habitaciones[]" value="${habitacion.id}">`;
                });

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Reserva exitosa',
                            text: 'Tu reserva ha sido realizada con éxito.',
                            confirmButtonText: 'Gracias'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al procesar tu reserva.',
                            confirmButtonText: 'Intentar nuevamente'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error en la reserva:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un problema con la reserva.',
                        confirmButtonText: 'Intentar nuevamente'
                    });
                });
            })
            .catch(error => {
                console.error('Error al obtener inventario:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al obtener la disponibilidad de las habitaciones.',
                    confirmButtonText: 'Intentar nuevamente'
                });
            });
    }
</script>

</body>
</html>
