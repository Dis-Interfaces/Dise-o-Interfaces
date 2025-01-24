<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="{{ asset('/css/Modulo_Facturas/facturas.css') }}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
      <div class="menu-item">
        <a href="{{ route('facturacion')}}">
      
      <div class="menu-item" aria-label="Facturas">
        <a href="{{ route('facturacion')}}"> 
          <img src="img/Facturas.png" alt="Facturas">
          <span>Facturas</span>
        </a>
      </div>
      <div class="menu-item">
      
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

      <div class="sidebar-title">
        <a href="{{ route('listar') }}">
          <span>Listar facturas</span>
        </a>
      </div>
    </div>

    <!-- Formulario para la factura -->
    <div class="main-content">
      <section>
        <h2>Datos del cliente</h2>
        <form id="factura-form">
          <label>Nombre del cliente:</label>
          <input type="text" name="nombre_cliente" required>

          <label>Apellido paterno:</label>
          <input type="text" name="apellido_paterno" required>

          <label>Apellido materno:</label>
          <input type="text" name="apellido_materno" required>

          <label>Nombre adicional:</label>
          <input type="text" name="nombre_adicional">

          <label>Número de teléfono:</label>
          <input type="tel" name="telefono" required>

          <label>Correo electrónico:</label>
          <input type="email" name="correo_electronico" required>
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
          <label>ID de la reservación:</label>
          <input type="text" name="id_reservacion" required>

          <label>Fecha de check-in:</label>
          <input type="date" name="fecha_checkin" required>

          <label>Fecha de check-out:</label>
          <input type="date" name="fecha_checkout" required>

          <label>Nombre del hotel:</label>
          <input type="text" name="nombre_hotel" required>

          <label>Dirección del hotel:</label>
          <input type="text" name="direccion_hotel" required>
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
          <label>Tipo de habitación:</label>
          <input type="text" name="tipo_habitacion" required>

          <label>Costo por noche:</label>
          <input type="number" name="costo_por_noche" id="costo_por_noche" required>

          <label>Noches en el hotel:</label>
          <input type="number" name="noches" id="noches" required>

          <label>IVA total:</label>
          <input type="number" name="iva" id="iva" value="16" required>

          <label>Descuento:</label>
          <input type="number" name="descuento" id="descuento" value="0" required>

          <label>Total a pagar:</label>
          <input type="text" name="total_a_pagar" id="total_a_pagar" readonly>
      </section>

      <div class="buttons">
        <button type="button" class="confirm-button" id="confirmar-btn">Confirmar datos</button>
        <button type="button" class="pay-button" id="pagar-btn">Pagar</button>
      </div>
    </form>
  </div>

  <script>
    // Función para calcular el total a pagar
    function calcularTotal() {
      const costoPorNoche = parseFloat(document.querySelector('input[name="costo_por_noche"]').value) || 0;
      const noches = parseInt(document.querySelector('input[name="noches"]').value) || 0;
      const iva = parseFloat(document.querySelector('input[name="iva"]').value) || 0;
      const descuento = parseFloat(document.querySelector('input[name="descuento"]').value) || 0;

      let total = costoPorNoche * noches;
      total += total * (iva / 100);
      total -= total * (descuento / 100);

      document.querySelector('input[name="total_a_pagar"]').value = total.toFixed(2);
    }

    // Escuchar cambios en los campos de los costos
    document.querySelector('input[name="costo_por_noche"]').addEventListener('input', calcularTotal);
    document.querySelector('input[name="noches"]').addEventListener('input', calcularTotal);
    document.querySelector('input[name="iva"]').addEventListener('input', calcularTotal);
    document.querySelector('input[name="descuento"]').addEventListener('input', calcularTotal);

    // Validaciones y notificaciones
    document.getElementById('confirmar-btn').addEventListener('click', function() {
      const form = document.getElementById('factura-form');
      if (form.checkValidity()) {
        Swal.fire({
          title: 'Confirmación',
          text: 'Los datos han sido confirmados. ¿Desea proceder con el pago?',
          icon: 'success',
          confirmButtonText: 'Sí, proceder',
          cancelButtonText: 'No',
          showCancelButton: true
        });
      } else {
        Swal.fire({
          title: 'Error',
          text: 'Por favor complete todos los campos requeridos.',
          icon: 'error',
          confirmButtonText: 'Ok'
        });
      }
    });

    document.getElementById('pagar-btn').addEventListener('click', function() {
      const total = parseFloat(document.querySelector('input[name="total_a_pagar"]').value);
      if (total > 0) {
        Swal.fire({
          title: 'Pago realizado',
          text: '¡Gracias por tu pago!',
          icon: 'success',
          confirmButtonText: 'Cerrar'
        });
      } else {
        Swal.fire({
          title: 'Error',
          text: 'El total a pagar no puede ser 0.',
          icon: 'error',
          confirmButtonText: 'Revisar datos'
        });
      }
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
