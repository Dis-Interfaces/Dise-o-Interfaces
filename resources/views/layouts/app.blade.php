<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Formulario con Validaciones</title>
</head>
<body>
    <header class="header">
        <a href="{{ route('ocupacion.index') }}">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-image">
                <span>HUPV</span>
            </div>
        </a>
        <div class="menu-items">
            <a href="{{ route('reservaciones.create') }}">
                <div class="menu-item {{ $currentSection == 'reservaciones' ? 'active' : '' }}">
                    <img src="{{ asset('img/reservaciones.svg') }}" alt="Reservaciones" class="reservaciones-image">
                    <span>Reservaciones</span>
                </div>
            </a>
            <a href="{{ route('clientes.index') }}">
                <div class="menu-item {{ $currentSection == 'clientes' ? 'active' : '' }}">
                    <img src="{{ asset('img/clientes.svg') }}" alt="Clientes" class="clientes-image">
                    <span>Clientes</span>
                </div>
            </a>
            <a href="{{ route('habitaciones.index') }}">
                <div class="menu-item {{ $currentSection == 'habitaciones' ? 'active' : '' }}">
                    <img src="{{ asset('img/habitaciones.svg') }}" alt="Habitaciones" class="habitaciones-image">
                    <span>Habitaciones</span>
                </div>
            </a>
            <a href="{{ route('personal.index') }}">
                <div class="menu-item {{ $currentSection == 'personal' ? 'active' : '' }}">
                    <img src="{{ asset('img/personal.svg') }}" alt="Personal" class="personal-image">
                    <span>Personal</span>
                </div>
            </a>
            <div class="menu-item {{ $currentSection == 'facturas' ? 'active' : '' }}">
                <img src="{{ asset('img/facturas.svg') }}" alt="Facturas" class="facturas-image">
                <span>Facturas</span>
            </div>
            <a href="{{ route('promociones.index') }}">
                <div class="menu-item {{ $currentSection == 'marketing' ? 'active' : '' }}">
                    <img src="{{ asset('img/marketing.svg') }}" alt="Marketing" class="marketing-image">
                    <span>Marketing</span>
                </div>
            </a>
            <a href="{{ route('inventario.index') }}">
                <div class="menu-item {{ $currentSection == 'inventario' ? 'active' : '' }}">
                    <img src="{{ asset('img/inventario.svg') }}" alt="Inventario" class="inventario-image">
                    <span>Inventario</span>
                </div>
            </a>
        </div>
        <a href="{{ route('index') }}" class="header-button" id="casa">Home</a>
        <div></div>
        <div class="action">
            <div class="profile" onclick="menuToggle();">
                <img src="{{ asset('img/settings_blue.png') }}" />
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <img src="{{ asset('img/user_blue.png') }}" />
                        <a href="{{ route('profile.show') }}">Mi Perfil</a>
                    </li>
                    <li>
                        <img src="{{ asset('img/log-out_blue.png') }}" class="logout" />
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="btn-ref" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
<form id="registro-form">
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email">
    <br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password">
    <br>

    <label for="confirm-password">Confirmar Contraseña:</label>
    <input type="password" id="confirm-password" name="confirm-password">
    <br>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">
    <br>

    <button type="submit">Registrar</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('registro-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir envío del formulario mientras validamos

        let errors = [];
        let hasError = false;

        // Validación de correo electrónico
        const emailInput = document.getElementById('email');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailInput.value)) {
            errors.push({ message: 'El correo electrónico no es válido.', icon: 'fa-envelope' });
            hasError = true;
        }

        // Validación de la contraseña
        const passwordInput = document.getElementById('password');
        if (passwordInput.value.length < 6) {
            errors.push({ message: 'La contraseña debe tener al menos 6 caracteres.', icon: 'fa-lock' });
            hasError = true;
        }

        // Validación de la confirmación de la contraseña
        const confirmPasswordInput = document.getElementById('confirm-password');
        if (passwordInput.value !== confirmPasswordInput.value) {
            errors.push({ message: 'Las contraseñas no coinciden.', icon: 'fa-exclamation-triangle' });
            hasError = true;
        }

        // Validación del campo de nombre
        const nombreInput = document.getElementById('nombre');
        if (nombreInput.value.trim() === "") {
            errors.push({ message: 'El nombre es obligatorio.', icon: 'fa-user' });
            hasError = true;
        }

        // Mostrar notificaciones de error
        if (hasError) {
            showErrorMessages(errors);
        } else {
            // Si no hay errores, puedes enviar el formulario o hacer alguna otra acción
            Swal.fire({
                title: 'Éxito',
                text: 'Formulario enviado correctamente.',
                icon: 'success',
                background: '#2e3b4e',
                customClass: {
                    title: 'swal-title',
                    input: 'swal-input'
                },
            });
        }
    });

    // Función para mostrar los mensajes de error
    function showErrorMessages(errors) {
        errors.forEach(error => {
            Swal.fire({
                title: 'Error',
                text: error.message,
                icon: 'error',
                background: '#2e3b4e',
                customClass: {
                    title: 'swal-title',
                    input: 'swal-input'
                },
                iconHtml: `<i class="fa ${error.icon}"></i>`, // Usar el icono especificado
            });
        });
    }
</script>
    <script>
      function menuToggle() {
        const toggleMenu = document.querySelector(".menu");
        toggleMenu.classList.toggle("active");
      }
      function narrar(texto) {
        window.speechSynthesis.cancel();
        const narrador = new SpeechSynthesisUtterance(texto);
        narrador.lang = 'es-ES';
        const vocesDisponibles = window.speechSynthesis.getVoices();
        const vozSeleccionada = vocesDisponibles.find(voz => voz.lang === 'es-ES');
        if (vozSeleccionada) {
            narrador.voice = vozSeleccionada;
        }
        window.speechSynthesis.speak(narrador);
      }

      document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function () {
            narrar(`Ingresado: ${this.value}`);
        });
      });
    </script>
</body>
</html>
