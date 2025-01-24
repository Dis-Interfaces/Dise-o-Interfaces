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
    <div class="logo">
      <img src="img/logo.png" class="logo-image" alt="Logo">
      <span>HUPV</span>
    </div>
    <div class="menu-items">
      <div class="menu-item">
        <img src="img/Mis_reservas.png" alt="Reservaciones">
        <span>Reservaciones</span>
      </div>
      <div class="menu-item">
        <img src="img/Clientes.png" alt="Clientes">
        <span>Clientes</span>
      </div>
      <div class="menu-item">
        <img src="img/Habitaciones1.png" alt="Habitaciones">
        <span>Habitaciones</span>
      </div>
      <div class="menu-item">
        <img src="img/Personal.png" alt="Personal">
        <span>Personal</span>
      </div>

      <div class="menu-item">
        <a href="{{ route('facturacion')}}">
          <img src="img/Facturas.png" alt="Facturas">
          <span>Facturas</span>
        </a>
      </div>

      <div class="menu-item">
        <img src="img/Marketing.png" alt="Marketing">
        <span>Marketing</span>
      </div>
      <div class="menu-item">
        <img src="img/Inventario.png" alt="Inventario">
        <span>Inventario</span>
      </div>
    </div>
    <div class="profile-icons">
      <img src="img/Calendario.png" alt="Calendar">
      <img src="img/Notificacion.png" alt="Notifications">
      <img src="img/Usuario.png" alt="User">
    </div>
  </div>

  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-title">
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
    });
  </script>
</body>
</html>
