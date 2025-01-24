<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head.content')
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

    <div class="content">
        <div class="sidebar">
            @yield('sidebar.content')
        </div>

        <div class="main">
            @yield('main.content') 
        </div>
    </div>

    @yield('body.content')

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
