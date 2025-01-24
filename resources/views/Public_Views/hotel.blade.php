    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel Booking</title>
        <link rel="stylesheet" href="{{ asset('/css/hotel.css') }}">
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
    <section id="booking-form">
        <div class="booking-container">
            <h2>HUPV</h2>
            <form>
                <div class="form-group">
                    <label for="arrival">LLEGADA</label>
                    <input type="date" id="arrival" 
                        onfocus="narrar('Campo de llegada. Seleccione una fecha');" 
                        oninput="narrar('LLEGADA: ' + formatDate(this.value));">
                </div>
                <div class="form-group">
                    <label for="departure">SALIDA</label>
                    <input type="date" id="departure" 
                        onfocus="narrar('Campo de salida. Seleccione una fecha');" 
                        oninput="narrar('SALIDA: ' + formatDate(this.value));">
                </div>
                <div class="form-group">
                    <label for="rooms">Número de habitaciones</label>
                    <select id="rooms" 
                        onfocus="narrar('Seleccione el número de habitaciones');" 
                        onchange="narrar('Habitaciones: ' + this.options[this.selectedIndex].text);">
                        <option onfocus="narrar('1 Habitación')">1 Habitación</option>
                        <option onfocus="narrar('2 Habitaciones')">2 Habitaciones</option>
                        <option onfocus="narrar('3 Habitaciones')">3 Habitaciones</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="adults">Número de adultos</label>
                    <select id="adults" 
                        onfocus="narrar('Seleccione el número de adultos');" 
                        onchange="narrar('Adultos: ' + this.options[this.selectedIndex].text);">
                        <option onfocus="narrar('1 Adulto')">1 Adulto</option>
                        <option onfocus="narrar('2 Adultos')">2 Adultos</option>
                        <option onfocus="narrar('3 Adultos')">3 Adultos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="children">Número de niños</label>
                    <select id="children" 
                        onfocus="narrar('Seleccione el número de niños');" 
                        onchange="narrar('Niños: ' + this.options[this.selectedIndex].text);">
                        <option onfocus="narrar('0 Niños')">0 Niños</option>
                        <option onfocus="narrar('1 Niño')">1 Niño</option>
                        <option onfocus="narrar('2 Niños')">2 Niños</option>
                    </select>
                </div>
                <button type="submit" onfocus="narrar('Botón para reservar. Presione para enviar el formulario');">RESERVAR</button>
            </form>
        </div>
    </section>


        <div class="hotels-section">
            <h1>Hoteles en Monterrey (Nuevo León, México)</h1>

            <div class="hotel-card" onmouseover="narrateHotelContent(this);">
                <img src="img/hotel.jpg" alt="Hotel Luna" class="hotel-image">
                <div class="hotel-info">
                    <div class="popular-tag">Opción popular</div>
                    <h2>Hotel Luna</h2>
                    <p>⭐⭐⭐⭐ Hotel</p>
                    <p>a 0.5 km de: Centro de la ciudad</p>
                    <p class="rating">7.6 - Buena (1,025 opiniones)</p>
                </div>
                <div class="price-info">
                    <p class="price">MXN$1,540 <span>por noche</span></p>
                    <p>Precio previsto para:</p>
                    <p>enero 2025</p>
                    <a href="{{ route('habitacion3') }}" aria-label="Reservar Hotel Luna" onmouseover="narrarTexto('Reservar Hotel Luna')">
                        <button class="price-button" onmouseover="narrarTexto('Reservar Hotel Luna')">Reservar</button>
                    </a>
                </div>
            </div>

            <div class="hotel-card" onmouseover="narrateHotelContent(this);">
                <img src="img/hotel2.jpg" alt="Hotel Sol" class="hotel-image">
                <div class="hotel-info">
                    <div class="popular-tag">Opción popular</div>
                    <h2>Hotel Sol</h2>
                    <p>⭐⭐⭐⭐⭐ Hotel</p>
                    <p>a 1 km de: Centro histórico</p>
                    <p class="rating">8.4 - Muy buena (1,586 opiniones)</p>
                </div>
                <div class="price-info">
                    <p class="price">MXN$1,542 <span>por noche</span></p>
                    <p>Precio previsto para:</p>
                    <p>enero 2025</p>
                    <a href="{{ route('habitacion') }}" aria-label="Reservar Hotel Sol" onmouseover="narrarTexto('Reservar Hotel Sol')">
                        <button class="price-button" onmouseover="narrarTexto('Reservar Hotel Sol')">Reservar</button>
                    </a>
                </div>
            </div>

            <div class="hotel-card" onmouseover="narrateHotelContent(this);">
                <img src="img/hotel3.jpg" alt="Hotel Mar" class="hotel-image">
                <div class="hotel-info">
                    <div class="popular-tag">Opción popular</div>
                    <h2>Hotel Mar</h2>
                    <p>⭐⭐⭐⭐⭐ Hotel</p>
                    <p>a 0.8 km de: Playa Mar</p>
                    <p class="rating">8.2 - Muy buena (1,000 opiniones)</p>
                </div>
                <div class="price-info">
                    <p class="price">MXN$1,750 <span>por noche</span></p>
                    <p>Precio previsto para:</p>
                    <p>enero 2025</p>
                    <a href="{{ route('habitacion2') }}" aria-label="Reservar Hotel Mar" onmouseover="narrarTexto('Reservar Hotel Mar')">
                        <button class="price-button" onmouseover="narrarTexto('Reservar Hotel Mar')">Reservar</button>
                    </a>
                </div>
            </div>

            <!-- Otros hoteles se mantienen con la misma estructura -->
        </div>

        <footer class="footer">
            <div class="footer-top">
                <div class="contact-info">
                    <p>LLÁMENOS</p>
                    <span>123 456 7890</span>
                </div>
                <div class="contact-info">
                    <p>ENVÍENOS UN CORREO</p>
                    <span>info@HUPV.com</span>
                </div>
                <div class="newsletter">
                    <p>REGISTRE SU CORREO PARA EL BOLETÍN</p>
                    <input type="text" placeholder="Tu correo" 
                        oninput="narrar('Email ingresado: ' + this.value);">
                    <button onfocus="narrar('Botón para enviar el correo del boletín')">ENVIAR</button>
                </div>
            </div>
        </footer>

        <script src="{{ asset('/js/script.js') }}"></script>
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
                    if (descripcion) narrar(descripcion);
                });
            });

            document.querySelectorAll('input, textarea, select').forEach(input => {
                input.addEventListener('input', () => {
                    const textoIngresado = input.value || input.options?.[input.selectedIndex]?.text;
                    narrar(textoIngresado);
                });
            });

            document.querySelectorAll('select').forEach(select => {
                select.addEventListener('focus', () => {
                    const label = select.previousElementSibling?.textContent || 'Seleccione una opción';
                    narrar(label);
                });

                select.addEventListener('change', () => {
                    const opcionSeleccionada = select.options[select.selectedIndex]?.text;
                    if (opcionSeleccionada) narrar(`Opción seleccionada: ${opcionSeleccionada}`);
                });
            });
            function narrarTexto(texto) {
                const narrador = new SpeechSynthesisUtterance(texto);
                narrador.lang = 'es-ES';
                speechSynthesis.speak(narrador);
            }

            function narrateHotelContent(hotelCard) {
                const hotelName = hotelCard.querySelector('h2').textContent;
                const stars = hotelCard.querySelector('.hotel-info p:first-of-type').textContent;
                const location = hotelCard.querySelector('.hotel-info p:nth-of-type(2)').textContent;
                const rating = hotelCard.querySelector('.rating').textContent;
                const price = hotelCard.querySelector('.price').textContent;

                const narracion = `
                    Hotel ${hotelName}.
                    Clasificación: ${stars}.
                    Ubicación: ${location}.
                    Opiniones: ${rating}.
                    Precio: ${price}.
                `;

                narrarTexto(narracion);
            }
        </script>

    </body>
    </html>
