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

<body>
    <!-- Barra de Navegación -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo.png" alt="Logo" class="logo-image">
                HUPV
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('hotel') }}">Hoteles</a></li>
                <li><a href="{{ route('contacto') }}">Contacto</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                <h1>Experience Luxury Beyond Ordinary</h1>
                <p>Book your dream stay today!</p>
            </div>
            <div class="slide" style="background-image: url('img/hotel5.jpg');">
                <h1 id="black">Relax and Unwind</h1>
                <p id="black">Find your perfect getaway</p>
            </div>
            <div class="slide" style="background-image: url('img/hotel3.jpg');">
                <h1>Relax and Unwind</h1>
                <p>Find your perfect getaway</p>
            </div>
            <div class="slide" style="background-image: url('img/hotel2.jpg');">
                <h1>Relax and Unwind</h1>
                <p>Find your perfect getaway</p>
            </div>
        </div>
    </section>



       
    <section id="booking-form">
    </section>
    
  <!-- Sección de ofertas -->
  <section class="hero">
    <div class="hero-content">
        <h1>Deja de Trabajar en Laravel y Ven a Vacacionar</h1>
        <p>No a los cuatris: <strong>de 3 meses</strong></p>
        <a href="#hotels">
            <button class="btn">Reserva Ahora</button>
        </a>
    </div>
</section>
<section id="hotels" class="hotels">
    <div class="hotel-card">
        <img src="img/hotel.jpg" alt="CHN Hotel Monterrey">
        <h3>Hotel Luna</h3>
        <p class="rating">7.6 <span>Buena</span> (1,025 opiniones)</p>
        <p class="price">
            MXN$1,540 <span class="old-price">MXN$2,200</span>
        </p>
        <p class="total">por noche<br>MXN$3,665 en total impuestos y cargos incluidos</p>
        <a href="{{ route('habitacion3') }}">
            <button class="btn">Reservar</button>
        </a>
    </div>
    <div class="hotel-card">
        <img src="img/hotel2.jpg" alt="Safi Royal Luxury Centro">
        <h3>Hotel Sol</h3>
        <p class="rating">8.4 <span>Muy buena</span> (1,586 opiniones)</p>
        <p class="price">
            MXN$1,542 <span class="old-price">MXN$3,465</span>
        </p>
        <p class="total">por noche<br>MXN$3,670 en total impuestos y cargos incluidos</p>
        <a href="{{ route('habitacion') }}">
            <button class="btn">Reservar</button>
        </a>
    </div>
    <div class="hotel-card">
        <img src="img/hotel3.jpg" alt="Radisson Hotel Monterrey">
        <h3>Hotel Mar</h3>
        <p class="rating">8.2 <span>Muy buena</span> (1,000 opiniones)</p>
        <p class="price">
            MXN$1,750 <span class="old-price">MXN$2,500</span>
        </p>
        <p class="total">por noche<br>MXN$4,165 en total impuestos y cargos incluidos</p>
        <a href="{{ route('habitacion2') }}">
            <button class="btn">Reservar</button>
        </a> 
       </div>
    <div class="hotel-card">
        <img src="img/hotel5.jpg" alt="Krystal Grand Suites Insurgentes">
        <h3>Hotel Sol</h3>
        <p class="rating">9.0 <span>Magnífica</span> (1,129 opiniones)</p>
        <p class="price">
            MXN$1,856 <span class="old-price">MXN$2,856</span>
        </p>
        <p class="total">por noche<br>MXN$4,436 en total impuestos y cargos incluidos</p>
        <a href="{{ route('habitacion') }}">
            <button class="btn">Reservar</button>
        </a>
    </div>
</section>
    

    <!-- Sección de informacion -->
        <section id="facilities" class="facilities-section">
            <h2 class="section-title">Informacion</h2>
            <!-- Navegación de Tabs -->
            <ul class="tab-navigation">
                <li><a href="#Vision">Vision</a></li>
                <li><a href="#Sobre_nosotros">Sobre Nosotros</a></li>
                <li><a href="#Mision">Mision</a></li>
           
            </ul>
        
            <!-- Contenedor de Contenidos -->
            <div class="tab-content-container">

                <div id="Vision" class="tab-content active">
                    <img src="img/hotel1.jpg" alt="Vision">
                    <div class="text-content">
                        <h3>Vision</h3>
                        <p>
                            Ser reconocidos como el hotel líder en hospitalidad y excelencia.
                            <br>Proveer experiencias únicas que superen las expectativas de nuestros huéspedes.
                            <br>Compromiso con la innovación y sostenibilidad.
                        </p>
                    </div>
                </div>
            
                <div id="Sobre_nosotros" class="tab-content">
                    <img src="img/hotel3.jpg" alt="Sobre_nosotros">
                    <div class="text-content">
                        <h3>Sobre Nosotros</h3>
                        <p>
                            Ofrecer servicios de alta calidad que combinen comodidad y estilo.
                            <br>Cuidar cada aspecto de la estadía de nuestros huéspedes.
                            <br>Convertirnos en el lugar predilecto para descansar y crear recuerdos.
                        </p>
                    </div>
                </div>

                <div id="Mision" class="tab-content">
                    <img src="img/hotel5.jpg" alt="Mision">
                    <div class="text-content">
                        <h3>Mision</h3>
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
        <div class="contact-info">
            <p>CALL US</p>
            <span>123 456 7890</span>
        </div>
        <div class="contact-info">
            <p>EMAIL US</p>
            <span>info@HUPV.com</span>
        </div>
        <div class="newsletter">
            <p>ENTER ID FOR NEWSLETTER</p>
            <input type="text" placeholder="Your Email">
            <button>GO</button>
        </div>
        <!--<div class="social-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
        </div>-->
    </div>
</footer>

    <!--
    <div class="footer-bottom">
        <div class="footer-column">
            <h3>HUPV</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consectetur tincidunt dolor.</p>
            <p>St Amsterdam Finland, United States of AKY16 8PN</p>
        </div>
        <div class="footer-column">
            <h3>QUICK LINKS</h3>
            <ul>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">Food & Drinks</a></li>
                <li><a href="#">Beach Venues</a></li>
                <li><a href="#">Amenities</a></li>
                <li><a href="#">Noordwijk</a></li>
                <li><a href="#">Wellness</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h3>WE ARE GLOBAL</h3>
            <img src="img/map.jpg" alt="World Map">
        </div>
    </div>
    <div class="footer-copyright">
        <p>&copy; 2015 HUPV. All rights reserved.</p>
    </div>
</footer>
    -->

    <!-- Vincula el script aquí -->
    <script src="{{ asset('/js/script.js') }}"></script>
</body>
</html>
