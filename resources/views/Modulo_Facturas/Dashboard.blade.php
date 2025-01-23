<!DOCTYPE html>
<html lang="en">
<head> 
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('/css/Modulo_Facturas/facturas.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <div class="header">
    <div class="logo" aria-label="Logo de HUPV">
      <img src="img/logo.png" class="logo-image" alt="Logo">
      <span>HUPV</span>
    </div>
    <div class="menu-items">
      <div class="menu-item" aria-label="Reservaciones">
        <img src="img/Mis_reservas.png" alt="Reservaciones">
        <span>Reservaciones</span>
      </div>
      <div class="menu-item" aria-label="Clientes">
        <img src="img/Clientes.png" alt="Clientes">
        <span>Clientes</span>
      </div>
      <div class="menu-item" aria-label="Habitaciones">
        <img src="img/Habitaciones1.png" alt="Habitaciones">
        <span>Habitaciones</span>
      </div>
      <div class="menu-item" aria-label="Personal">
        <img src="img/Personal.png" alt="Personal">
        <span>Personal</span>
      </div>
      
      <div class="menu-item" aria-label="Facturas">
        <a href="{{ route('facturacion')}}"> 
          <img src="img/Facturas.png" alt="Facturas">
          <span>Facturas</span>
        </a>
      </div>
      
      <div class="menu-item" aria-label="Marketing">
        <img src="img/Marketing.png" alt="Marketing">
        <span>Marketing</span>
      </div>
      <div class="menu-item" aria-label="Inventario">
        <img src="img/Inventario.png" alt="Inventario">
        <span>Inventario</span>
      </div>
    </div>
    <div class="profile-icons">
      <img src="img/Calendario.png" alt="Calendar" aria-label="Calendario">
      <img src="img/Notificacion.png" alt="Notifications" aria-label="Notificaciones">
      <img src="img/Usuario.png" alt="User" aria-label="Usuario">
    </div>
  </div>

  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-title" aria-label="Hacer factura">
        <span>Hacer factura</span>
      </div>

      <div class="sidebar-title" aria-label="Listar facturas">
      <a href="{{ route('listar') }}">
        <span>Listar facturas</span>
      </a> 
      </div>
    </div>

    <!-- Formulario para factura -->
    <div class="main-content">
      <section>
        <h2>Datos del cliente</h2>
        <form>
          <label aria-label="Nombre del cliente">Nombre del cliente:</label>
          <input type="text" name="nombre_cliente" aria-label="Campo para el nombre del cliente">
          
          <label aria-label="Apellido paterno">Apellido paterno:</label>
          <input type="text" name="apellido_paterno" aria-label="Campo para el apellido paterno">
          
          <label aria-label="Apellido materno">Apellido materno:</label>
          <input type="text" name="apellido_materno" aria-label="Campo para el apellido materno">
          
          <label aria-label="Nombre adicional">Nombre adicional:</label>
          <input type="text" name="nombre_adicional" aria-label="Campo para el nombre adicional">
          
          <label aria-label="Número de teléfono">Número de teléfono:</label>
          <input type="tel" name="telefono" aria-label="Campo para el número de teléfono">
          
          <label aria-label="Correo electrónico">Correo electrónico:</label>
          <input type="email" name="correo_electronico" aria-label="Campo para el correo electrónico">
        </form>
      </section>

      <section>
        <h2>Datos de la reservación</h2>
        <form>
          <label aria-label="ID de la reservación">ID de la reservación:</label>
          <input type="text" name="id_reservacion" aria-label="Campo para el ID de la reservación">
          
          <label aria-label="Fecha de check-in">Fecha de check-in:</label>
          <input type="date" name="fecha_checkin" aria-label="Campo para la fecha de check-in">
          
          <label aria-label="Fecha de check-out">Fecha de check-out:</label>
          <input type="date" name="fecha_checkout" aria-label="Campo para la fecha de check-out">
          
          <label aria-label="Nombre del hotel">Nombre del hotel:</label>
          <input type="text" name="nombre_hotel" aria-label="Campo para el nombre del hotel">
          
          <label aria-label="Dirección del hotel">Dirección del hotel:</label>
          <input type="text" name="direccion_hotel" aria-label="Campo para la dirección del hotel">
        </form>
      </section>

      <section>
        <h2>Costos</h2>
        <form>
          <label aria-label="Tipo de habitación">Tipo de habitación:</label>
          <input type="text" name="tipo_habitacion" aria-label="Campo para el tipo de habitación">
          
          <label aria-label="Costo por noche">Costo por noche:</label>
          <input type="text" name="costo_por_noche" aria-label="Campo para el costo por noche">
          
          <label aria-label="Noches en el hotel">Noches en el hotel:</label>
          <input type="number" name="noches" aria-label="Campo para las noches en el hotel">
          
          <label aria-label="IVA total">IVA total:</label>
          <input type="text" name="iva" aria-label="Campo para el IVA total">
          
          <label aria-label="Descuento">Descuento:</label>
          <input type="text" name="descuento" aria-label="Campo para el descuento">
          
          <label aria-label="Total a pagar">Total a pagar:</label>
          <input type="text" name="total_a_pagar" readonly aria-label="Campo para el total a pagar">
        </form>
      </section>

      <div class="buttons">
        <button class="confirm-button" aria-label="Confirmar datos">Confirmar datos</button>
        <button class="pay-button" aria-label="Pagar">Pagar</button>
      </div>
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
