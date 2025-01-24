<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        /* Toast Notification Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            opacity: 0;
            transform: translateX(100%);
            animation: slideIn 0.5s forwards, fadeOut 0.5s 3s forwards;
        }

        .toast i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        @keyframes slideIn {
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="menu container" aria-label="Logo de la aplicación HUPV">
            <h1>HUPV</h1>
            <p>Reservaciones de Hoteles</p>
            <form id="registerForm" method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Register</h2>

                <div class="input-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus aria-label="Campo para ingresar el nombre">
                </div>

                <div class="input-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" value="{{ old('apellidos') }}" required aria-label="Campo para ingresar los apellidos">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required aria-label="Campo para ingresar el correo electrónico">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required aria-label="Campo para ingresar la contraseña">
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required aria-label="Campo para confirmar la contraseña">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}" aria-label="Enlace para ir a la página de inicio de sesión">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="login-button" aria-label="Botón para registrarse">Register</button>
                </div>
            </form>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script>
        const errorSound = new Audio('sonidos/error.mp3');

        document.getElementById('registerForm').addEventListener('submit', function(event) {
            let errors = [];

            const nameInput = document.getElementById('name');
            const apellidosInput = document.getElementById('apellidos');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');

            if (nameInput.value.trim() === '') {
                errors.push({ message: 'El campo de nombre es obligatorio.', icon: 'fa-exclamation-circle' });
            }

            if (apellidosInput.value.trim() === '') {
                errors.push({ message: 'El campo de apellidos es obligatorio.', icon: 'fa-exclamation-circle' });
            }

            if (!emailInput.value.includes('@')) {
                errors.push({ message: 'El correo electrónico debe ser válido.', icon: 'fa-exclamation-circle' });
            }

            if (passwordInput.value.length < 6) {
                errors.push({ message: 'La contraseña debe tener al menos 6 caracteres.', icon: 'fa-lock' });
            }

            if (passwordInput.value !== passwordConfirmInput.value) {
                errors.push({ message: 'Las contraseñas no coinciden.', icon: 'fa-exclamation-circle' });
            }

            if (errors.length > 0) {
                event.preventDefault();
                errorSound.play();

                errors.forEach(error => {
                    showToast(error.message, error.icon);
                });

                const allMessages = errors.map(error => error.message).join('. ');
                narrar(allMessages);
            }
        });

        function showToast(message, icon) {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.classList.add('toast');
            toast.innerHTML = `<i class="fas ${icon}"></i> ${message}`;
            toastContainer.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3500);
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

        document.querySelectorAll('[aria-label]').forEach(elemento => {
            elemento.addEventListener('mouseover', () => {
                const descripcion = elemento.getAttribute('aria-label');
                narrar(descripcion);
            });
        });
    </script>
</body>
</html>
