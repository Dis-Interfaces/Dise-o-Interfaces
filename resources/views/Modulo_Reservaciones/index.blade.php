@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <!-- Notificaciones de éxito, error o advertencia -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <main class="table" id="reservaciones_table">
        <section class="table__header">
            <h1>Lista de Reservaciones</h1>
            <div class="input-group">
                <input type="search" placeholder="Buscar..." id="search" onkeyup="searchTable()">
            </div>
            <div class="top-bar">
                <a href="{{ route('reservaciones.create') }}" class="edit-button">Añadir Reservación</a>
            </div>
        </section>

        <section class="table__body">
            <table id="reservationsTable">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Fecha Entrada</th>
                        <th>Fecha Salida</th>
                        <th>Tipo</th>
                        <th>Monto Total</th>
                        <th>Método Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td>{{ $reservacion->codigo_reservacion }}</td>
                            <td>{{ $reservacion->nombre }}</td>
                            <td>{{ $reservacion->email }}</td>
                            <td>{{ $reservacion->telefono }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($reservacion->tipo_reservacion) }}</td>
                            <td>${{ number_format($reservacion->monto_total, 2) }}</td>
                            <td>{{ ucfirst($reservacion->metodo_pago) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="edit-button">Editar</a>
                                    <form action="{{ route('reservaciones.destroy', $reservacion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta reservación?')">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</div>

@endsection

@section('body.content')
<script>
    // Función de búsqueda en la tabla
    function searchTable() {
        let input = document.getElementById("search");
        let filter = input.value.toLowerCase();
        let table = document.getElementById("reservationsTable");
        let tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName("td");
            let match = false;
            for (let j = 0; j < td.length; j++) {
                if (td[j]) {
                    let textValue = td[j].textContent || td[j].innerText;
                    if (textValue.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                    }
                }
            }
            tr[i].style.display = match ? "" : "none";
        }
    }

</script>

@endsection
