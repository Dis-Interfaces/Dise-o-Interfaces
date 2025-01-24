<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="menu container" aria-label="Logo de la aplicación HUPV">
            <h1>HUPV</h1>
            <p>Reservaciones de Hoteles</p>
            <form method="POST" action="{{ route('login') }}">
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
            input.addEventListener('input', () => {
                const textoIngresado = input.value;
                narrar(textoIngresado);
            });
        });
    </script>

</body>
</html>
