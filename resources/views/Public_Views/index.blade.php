<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/ofertas.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        <div class="slider" role="region" aria-labelledby="slider-heading">
            <h2 id="slider-heading" class="visually-hidden"></h2>

            <!-- Slide 1 -->
            <div class="slide" style="background-image: url('img/hotel.jpg');" role="tabpanel" aria-labelledby="slide1-heading" tabindex="0" onmouseover="narrarTexto('Slide 1: Experience Luxury Beyond Ordinary')">
                <h3 id="slide1-heading" class="visually-hidden">Experience Luxury Beyond Ordinary</h3>
                <p>Experience Luxury Beyond Ordinary</p>
                <p>Book your dream stay today!</p>
            </div>
            
            <!-- Slide 2 -->
            <div class="slide" style="background-image: url('img/hotel5.jpg');" role="tabpanel" aria-labelledby="slide2-heading" tabindex="0" onmouseover="narrarTexto('Slide 2: Relax and Unwind')">
                <h3 id="slide2-heading" class="visually-hidden">Relax and Unwind</h3>
                <p>Relax and Unwind</p>
                <p>Find your perfect getaway</p>
            </div>

            <!-- Slide 3 -->
            <div class="slide" style="background-image: url('img/hotel3.jpg');" role="tabpanel" aria-labelledby="slide3-heading" tabindex="0" onmouseover="narrarTexto('Slide 3: Relax and Unwind')">
                <h3 id="slide3-heading" class="visually-hidden">Relax and Unwind</h3>
                <p>Relax and Unwind</p>
                <p>Find your perfect getaway</p>
            </div>

            <!-- Slide 4 -->
            <div class="slide" style="background-image: url('img/hotel2.jpg');" role="tabpanel" aria-labelledby="slide4-heading" tabindex="0" onmouseover="narrarTexto('Slide 4: Relax and Unwind')">
                <h3 id="slide4-heading" class="visually-hidden">Relax and Unwind</h3>
                <p>Relax and Unwind</p>
                <p>Find your perfect getaway</p>
            </div>
        </div>
    </section>

    <section id="booking-form">
    </section>
    
    <!-- Sección de ofertas -->
    <section class="hero">
        <div class="hero-content">
            <h1 aria-label="Deja de trabajar en Laravel y ven a vacacionar" onmouseover="narrarTexto('Deja de trabajar en Laravel y ven a vacacionar')">Deja de Trabajar en Laravel y Ven a Vacacionar</h1>
            <p>No a los cuatris: <strong>de 3 meses</strong></p>
            <a href="#hotels" onclick="narrarTexto('Ir a la sección de hoteles')" onmouseover="narrarTexto('Ir a la sección de hoteles')">
                <button class="btn" aria-label="Reserva ahora" onmouseover="narrarTexto('Reserva ahora')">Reserva Ahora</button>
            </a>
        </div>
    </section>

    <section id="hotels" class="hotels">
        <div class="hotel-card" aria-label="Hotel Luna" onmouseover="narrarTexto('Hotel Luna: Calificación 7.6, buena con precio de MXN$1,540 por noche')">
            <img src="img/hotel.jpg" alt="Imagen del Hotel Luna" class="hotel-image" onmouseover="narrarTexto('Imagen del Hotel Luna')">
            <h3>Hotel Luna</h3>
            <p class="rating">7.6 <span>Buena</span> (1,025 opiniones)</p>
            <p class="price">
                MXN$1,540 <span class="old-price">MXN$2,200</span>
            </p>
            <p class="total">por noche<br>MXN$3,665 en total impuestos y cargos incluidos</p>
            <a href="{{ route('habitacion3') }}" aria-label="Reservar Hotel Luna" onmouseover="narrarTexto('Reservar Hotel Luna')">
                <button class="btn" onclick="narrarTexto('Reservar Hotel Luna')" onmouseover="narrarTexto('Reservar Hotel Luna')">Reservar</button>
            </a>
        </div>

        <div class="hotel-card" aria-label="Hotel Sol" onmouseover="narrarTexto('Hotel Sol: Calificación 8.4, muy buena con precio de MXN$1,542 por noche')">
            <img src="img/hotel2.jpg" alt="Imagen del Hotel Sol" class="hotel-image" onmouseover="narrarTexto('Imagen del Hotel Sol')">
            <h3>Hotel Sol</h3>
            <p class="rating">8.4 <span>Muy buena</span> (1,586 opiniones)</p>
            <p class="price">
                MXN$1,542 <span class="old-price">MXN$3,465</span>
            </p>
            <p class="total">por noche<br>MXN$3,670 en total impuestos y cargos incluidos</p>
            <a href="{{ route('habitacion') }}" aria-label="Reservar Hotel Sol" onmouseover="narrarTexto('Reservar Hotel Sol')">
                <button class="btn" onclick="narrarTexto('Reservar Hotel Sol')" onmouseover="narrarTexto('Reservar Hotel Sol')">Reservar</button>
            </a>
        </div>

        <div class="hotel-card" aria-label="Hotel Mar" onmouseover="narrarTexto('Hotel Mar: Calificación 8.2, muy buena con precio de MXN$1,750 por noche')">
            <img src="img/hotel3.jpg" alt="Imagen del Hotel Mar" class="hotel-image" onmouseover="narrarTexto('Imagen del Hotel Mar')">
            <h3>Hotel Mar</h3>
            <p class="rating">8.2 <span>Muy buena</span> (1,000 opiniones)</p>
            <p class="price">
                MXN$1,750 <span class="old-price">MXN$2,500</span>
            </p>
            <p class="total">por noche<br>MXN$4,165 en total impuestos y cargos incluidos</p>
            <a href="{{ route('habitacion2') }}" aria-label="Reservar Hotel Mar" onmouseover="narrarTexto('Reservar Hotel Mar')">
                <button class="btn" onclick="narrarTexto('Reservar Hotel Mar')" onmouseover="narrarTexto('Reservar Hotel Mar')">Reservar</button>
            </a> 
        </div>

        <div class="hotel-card" aria-label="Krystal Grand Suites Insurgentes" onmouseover="narrarTexto('Krystal Grand Suites Insurgentes: Calificación 9.0, magnífica con precio de MXN$1,856 por noche')">
            <img src="img/hotel5.jpg" alt="Imagen del Hotel Krystal Grand Suites Insurgentes" class="hotel-image" onmouseover="narrarTexto('Imagen del Hotel Krystal Grand Suites Insurgentes')">
            <h3>Hotel Sol</h3>
            <p class="rating">9.0 <span>Magnífica</span> (1,129 opiniones)</p>
            <p class="price">
                MXN$1,856 <span class="old-price">MXN$2,856</span>
            </p>
            <p class="total">por noche<br>MXN$4,436 en total impuestos y cargos incluidos</p>
            <a href="{{ route('habitacion') }}" aria-label="Reservar Hotel Sol" onmouseover="narrarTexto('Reservar Hotel Sol')">
                <button class="btn" onclick="narrarTexto('Reservar Hotel Sol')" onmouseover="narrarTexto('Reservar Hotel Sol')">Reservar</button>
            </a>
        </div>
    </section>

    <!-- Sección de información -->
    <section id="facilities" class="facilities-section">
    <h2 class="section-title" aria-label="Información sobre el hotel" 
        onmouseover="narrarTexto('Información sobre el hotel')">
        Información
    </h2>

    <ul class="tab-navigation">
        <li>
            <a href="#Vision" aria-label="Ir a la sección de Visión" 
                onclick="narrarTexto('Ir a la sección de Visión')" 
                onmouseover="narrarTexto('Ir a la sección de Visión, donde podrás ver nuestra visión de ser el hotel líder en hospitalidad y excelencia.')">
                Vision
            </a>
        </li>
        <li>
            <a href="#Sobre_nosotros" aria-label="Ir a la sección Sobre Nosotros" 
                onclick="narrarTexto('Ir a la sección Sobre Nosotros')" 
                onmouseover="narrarTexto('Ir a la sección Sobre Nosotros, donde ofrecemos servicios de alta calidad y estilo.')">
                Sobre Nosotros
            </a>
        </li>
        <li>
            <a href="#Mision" aria-label="Ir a la sección de Misión" 
                onclick="narrarTexto('Ir a la sección de Misión')" 
                onmouseover="narrarTexto('Ir a la sección de Misión, nuestro objetivo es proporcionar comodidad y cuidado a nuestros huéspedes.')">
                Mision
            </a>
        </li>
    </ul>

    <div class="tab-content-container">
        <div id="Vision" class="tab-content active" aria-label="Contenido de Visión" 
            onmouseover="narrarTexto('Contenido de Visión: Ser reconocidos como el hotel líder en hospitalidad y excelencia, proveyendo experiencias únicas y comprometidos con la innovación y sostenibilidad.')">
            <img src="img/hotel1.jpg" alt="Imagen relacionada con Visión" class="tab-image" 
                onmouseover="narrarTexto('Imagen relacionada con Visión: muestra el compromiso con la excelencia del hotel.')">
            <div class="text-content" aria-label="Descripción de la visión" 
                onmouseover="narrarTexto('Descripción de la visión: Ser reconocidos como el hotel líder en hospitalidad y excelencia, proveyendo experiencias únicas y sostenibles.')">
                <h3>Vision</h3>
                <p>
                    Ser reconocidos como el hotel líder en hospitalidad y excelencia.
                    <br>Proveer experiencias únicas que superen las expectativas de nuestros huéspedes.
                    <br>Compromiso con la innovación y sostenibilidad.
                </p>
            </div>
        </div>

        <div id="Sobre_nosotros" class="tab-content" aria-label="Contenido de Sobre Nosotros" 
            onmouseover="narrarTexto('Contenido de Sobre Nosotros: Ofrecemos servicios de alta calidad, cuidando cada aspecto de la estadía de nuestros huéspedes, y nos convertimos en el lugar predilecto para descansar.')">
            <img src="img/hotel3.jpg" alt="Imagen relacionada con Sobre Nosotros" class="tab-image" 
                onmouseover="narrarTexto('Imagen relacionada con Sobre Nosotros: muestra nuestro compromiso con el confort y la calidad en cada detalle.')">
            <div class="text-content" aria-label="Descripción de la sección Sobre Nosotros" 
                onmouseover="narrarTexto('Descripción de la sección Sobre Nosotros: ofrecer servicios de alta calidad, combinando comodidad y estilo.')">
                <h3>Sobre Nosotros</h3>
                <p>
                    Ofrecer servicios de alta calidad que combinen comodidad y estilo.
                    <br>Cuidar cada aspecto de la estadía de nuestros huéspedes.
                    <br>Convertirnos en el lugar predilecto para descansar y crear recuerdos.
                </p>
            </div>
        </div>

        <div id="Mision" class="tab-content" aria-label="Contenido de Misión" 
            onmouseover="narrarTexto('Contenido de Misión: Nuestra misión es ofrecer servicios de alta calidad, garantizando comodidad, estilo y cuidado para nuestros huéspedes.')">
            <img src="img/hotel5.jpg" alt="Imagen relacionada con Misión" class="tab-image" 
                onmouseover="narrarTexto('Imagen relacionada con Misión: refleja la dedicación de nuestro equipo para ofrecer una experiencia memorable a nuestros huéspedes.')">
            <div class="text-content" aria-label="Descripción de la misión" 
                onmouseover="narrarTexto('Descripción de la misión: nuestra misión es ofrecer servicios excepcionales, priorizando el confort y el descanso de nuestros huéspedes.')">
                <h3>Misión</h3>
                <p>
                    Ofrecer servicios de alta calidad que combinen comodidad y estilo.
                    <br>Cuidar cada aspecto de la estadía de nuestros huéspedes.
                    <br>Convertirnos en el lugar predilecto para descansar y crear recuerdos.
                </p>
            </div>
        </div>
    </div>
</section>


    <!-- Pie de página -->
    <footer class="footer">
        <div class="footer-top">
            <div class="contact-info" onmouseover="narrarTexto('Llámanos: 123 456 7890')">
                <p>CALL US</p>
                <span>123 456 7890</span>
            </div>
            <div class="contact-info" onmouseover="narrarTexto('Correo electrónico: info@HUPV.com')">
                <p>EMAIL US</p>
                <span>info@HUPV.com</span>
            </div>
            <div class="newsletter" onmouseover="narrarTexto('Introduce tu correo para el boletín')">
                <p>ENTER ID FOR NEWSLETTER</p>
                <input type="text" placeholder="Your Email" aria-label="Ingresa tu correo para boletín" oninput="narrarTexto(this.value)">
                <button onclick="narrarTexto('Enviar correo de suscripción')" onmouseover="narrarTexto('Enviar correo de suscripción')">GO</button>
            </div>
        </div>
    </footer>

    <script src="{{ asset('/js/script.js') }}"></script>

    <script>
        function narrarTexto(texto) {
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
    </script>
</body>
</html>
