<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="menu container" aria-label="Logo de la aplicación HUPV">
            <h1>HUPV</h1>
            <p>Reservaciones de Hoteles</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h2>Register</h2>

                <div class="input-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus aria-label="Campo para ingresar el nombre">
                </div>

                <div class="input-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" value="{{ old('apellidos') }}" required autofocus aria-label="Campo para ingresar los apellidos">
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

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', (event) => {
                narrar(event.target.value);
            });
        });
    </script>
</body>
</html>
