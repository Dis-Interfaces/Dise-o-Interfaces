<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/contacto.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
      .nav-links .active a {
            color: #007BFF;
            font-weight: bold;
            text-decoration: underline;
        }
</style>
<body>
    <!-- Barra de Navegación -->
   <!-- Barra de Navegación -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" class="logo-image" aria-label="Logo de la aplicación HUPV">
                HUPV
            </div>
            <ul class="nav-links">
                <li class="{{ request()->routeIs('index') ? 'active' : '' }}">
                    <a href="{{ route('index') }}" aria-label="Ir a la página de inicio">Home</a>
                </li>
                <li class="{{ request()->routeIs('hotel') ? 'active' : '' }}">
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

    
    <!-- Encabezado Principal -->
    <section class="hero">
        <div class="slider">
            <div class="slide" style="background-image: url('img/hotel.jpg');">
                <h1 aria-label="Experimenta el lujo más allá de lo ordinario">Experience Luxury Beyond Ordinary</h1>
                <p aria-label="Reserva tu estancia soñada hoy">Book your dream stay today!</p>
                <button aria-label="Explorar más">Explore</button>
            </div>
            <!-- Se repiten las otras diapositivas con descripciones en aria-label -->
        </div>
    </section>

    <!-- Sección de contacto -->
    <div class="contact-section">
        <div class="form-section">
          <h2 aria-label="Envíanos un correo">Send Us an Email</h2>
          <form action="#" method="post">
            <div class="form-row">
              <input type="text" name="first_name" placeholder="First Name *" required id="first_name" aria-label="Campo para ingresar el nombre">
              <input type="text" name="last_name" placeholder="Last Name *" required id="last_name" aria-label="Campo para ingresar el apellido">
            </div>
            <div class="form-row">
              <input type="email" name="email" placeholder="Your Email ID *" required id="email" aria-label="Campo para ingresar el correo electrónico">
              <input type="tel" name="phone" placeholder="Phone Number *" required id="phone" aria-label="Campo para ingresar el número de teléfono">
            </div>
            <textarea name="message" rows="4" placeholder="Message" id="message" aria-label="Campo para escribir un mensaje"></textarea>
            <button type="submit" aria-label="Enviar el formulario de contacto">Submit Now</button>
          </form>
        </div>
        <!-- Información de contacto con aria-labels -->
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="footer-top">
            <div class="contact-info">
                <p aria-label="Llámanos">CALL US</p>
                <span>123 456 7890</span>
            </div>
            <div class="contact-info">
                <p aria-label="Envíanos un correo">EMAIL US</p>
                <span>info@HUPV.com</span>
            </div>
            <div class="newsletter">
                <p aria-label="Introduce tu correo para recibir el boletín">ENTER ID FOR NEWSLETTER</p>
                <input type="text" placeholder="Your Email" id="newsletter-email" aria-label="Campo para ingresar el correo electrónico del boletín">
                <button aria-label="Suscribirse al boletín">GO</button>
            </div>
        </div>
    </footer>

    <!-- Script del narrador -->
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

        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('input', () => {
                const textoIngresado = input.value;
                narrar(textoIngresado);
            });
        });
    </script>

</body>
</html>
