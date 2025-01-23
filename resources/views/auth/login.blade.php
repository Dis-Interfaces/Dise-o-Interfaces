<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <title>Login</title>
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

        /* Input Focus Styles */
        .input-group input:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="menu container" aria-label="Logo de la aplicación HUPV">
            <h1>HUPV</h1>
            <p>Reservaciones de Hoteles</p>
            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <h2>Login</h2>
                <div class="input-group">
                    <label for="email">User</label>
                    <input type="email" id="email" name="email" placeholder="User" value="{{ old('email') }}" required autofocus aria-label="Campo para ingresar el correo electrónico">
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required aria-label="Campo para ingresar la contraseña">
                </div>
                <button type="submit" class="login-button" aria-label="Botón para iniciar sesión">Login</button>
                <p class="signup-text">Don't Have an Account? <a href="{{ route('register') }}" aria-label="Enlace para registrarse en una nueva cuenta">SIGN UP</a></p>
            </form>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script>
        let errorSound;

        document.addEventListener('DOMContentLoaded', () => {
            errorSound = new Audio('sonidos/error.mp3');
        });

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            let hasError = false;

            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            if (!emailInput.value.includes('@')) {
                errors.push({ message: 'El correo electrónico debe ser válido.', icon:  'fa-exclamation-circle' });
                hasError = true;
            }

            if (passwordInput.value.length < 6) {
                errors.push({ message: 'La contraseña debe tener al menos 6 caracteres.', icon: 'fa-lock' });
                hasError = true;
            }

            if (hasError) {
                event.preventDefault();
                errorSound.play();
            }
        });

        function showToast(message, icon) {
            const toastContainer = document.getElementById('toastContainer');

            const toast = document.createElement('div');
            toast.classList.add('toast');
            toast.innerHTML = `<i class="fas ${icon}"></i> ${message}`;

            toastContainer.appendChild(toast);

            narrar(message);

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
