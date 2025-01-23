@extends('layouts.app')

@section('main.content')
<div class="container">
    <h1>Crear Reservación</h1>
    <form action="{{ route('reservaciones.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del Cliente</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="hotel_id">Hotel:</label>
            <select id="hotel_id" name="hotel_id" class="form-control" onchange="fetchOptions()" required>
                <option value="">Seleccione un hotel</option>
                @foreach ($hoteles as $hotel)
                    <option value="{{ $hotel->id }}">{{ $hotel->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_habitacion_id">Tipo de Habitación:</label>
            <select id="tipo_habitacion_id" name="tipo_habitacion_id" class="form-control" onchange="fetchOptions()" required>
                <option value="">Seleccione un tipo</option>
                <option value="1">Individual</option>
                <option value="2">Doble</option>
                <option value="3">Suite</option>
                <option value="4">Suite Presidencial</option>
                <option value="5">Familiar</option>
            </select>
        </div>

        <select id="habitaciones" name="habitaciones[]">
        </select>

        <div class="form-group">
            <label for="fecha_entrada">Fecha de Entrada</label>
            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fecha_salida">Fecha de Salida</label>
            <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" required>
        </div>

        <div id="inventario">
        </div>

        <div class="form-group">
            <label for="codigo_promocional">Cupón Promocional</label>
            <input type="text" name="codigo_promocional" id="codigo_promocional" class="form-control">
        </div>

        <div class="form-group">
            <label for="notas">Notas</label>
            <textarea name="notas" id="notas" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Reservar</button>
    </form>
</div>

@if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Entendido'
            });
        };
    </script>
@endif

<div id="loading" style="display:none;">Cargando...</div>

<script>
function fetchOptions() {
    const hotelId = document.getElementById('hotel_id').value;
    const tipoHabitacionId = document.getElementById('tipo_habitacion_id').value;

    if (!hotelId || !tipoHabitacionId) {
        return; // Evita ejecutar la búsqueda si no se seleccionan los filtros necesarios
    }

    document.getElementById('loading').style.display = 'block'; // Muestra el indicador de carga

    fetch(`/api/filtrar-datos?hotel_id=${hotelId}&tipo_habitacion_id=${tipoHabitacionId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('loading').style.display = 'none'; // Oculta el indicador de carga

            const habitacionesSelect = document.getElementById('habitaciones');
            habitacionesSelect.innerHTML = '';
            if (data.habitaciones && data.habitaciones.length) {
                data.habitaciones.forEach(habitacion => {
                    habitacionesSelect.innerHTML += `
                        <option name="habitaciones" value="${habitacion.id}">${habitacion.numero_habitacion}</option>
                    `;
                });
            } else {
                habitacionesSelect.innerHTML = '<option disabled>No hay habitaciones disponibles</option>';
            }

            const inventarioDiv = document.getElementById('inventario');
            inventarioDiv.innerHTML = '';
            if (data.inventario && data.inventario.length) {
                data.inventario.forEach(item => {
                    inventarioDiv.innerHTML += `
                        <div class="form-group d-flex align-items-center">
                            <label class="mr-3">${item.nombre_producto}</label>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="updateQuantity(${item.id_producto}, -1)">-</button>
                            <input type="number" id="cantidad_${item.id_producto}" value="0" min="0" class="form-control mx-2 text-center" style="width: 60px;" readonly>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="updateQuantity(${item.id_producto}, 1)">+</button>
                        </div>
                    `;
                });
            } else {
                inventarioDiv.innerHTML = '<p>No hay productos en inventario</p>';
            }
        })
        .catch(error => {
            document.getElementById('loading').style.display = 'none';
            alert('Hubo un error al obtener los datos.');
        });
}

function updateQuantity(productId, change) {
    const cantidadInput = document.getElementById(`cantidad_${productId}`);
    let cantidad = parseInt(cantidadInput.value);

    cantidad = Math.max(0, cantidad + change);
    cantidadInput.value = cantidad;

    fetch(`/api/actualizar-inventario`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id_producto: productId,
            cantidad: cantidad
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Inventario actualizado:', data);
    })
    .catch(error => {
        console.error('Error al actualizar el inventario:', error);
    });
}
</script>
@endsection
