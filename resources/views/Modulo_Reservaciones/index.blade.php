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
            <h1 aria-label="Lista de Reservaciones">Lista de Reservaciones</h1>
            <div class="input-group">
                <input type="search" placeholder="Buscar..." id="search" onkeyup="searchTable()">
                <input type="search" placeholder="Buscar..." aria-label="Campo de búsqueda de reservaciones">
            </div>
            <div class="top-bar">
                <a href="{{ route('reservaciones.create') }}" class="edit-button" aria-label="Añadir una nueva reservación">Añadir Reservación</a>
            </div>
        </section>

        <section class="table__body">
            <table id="reservationsTable">
                <thead>
                    <tr>
                        <th aria-label="Código de la reservación">Código</th>
                        <th aria-label="Nombre del cliente">Cliente</th>
                        <th aria-label="Email del cliente">Email</th>
                        <th aria-label="Teléfono del cliente">Teléfono</th>
                        <th aria-label="Fecha de entrada en la reservación">Fecha Entrada</th>
                        <th aria-label="Fecha de salida de la reservación">Fecha Salida</th>
                        <th aria-label="Tipo de la reservación">Tipo</th>
                        <th aria-label="Monto total de la reservación">Monto Total</th>
                        <th aria-label="Método de pago de la reservación">Método Pago</th>
                        <th aria-label="Acciones disponibles para la reservación">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td aria-label="Código de la reservación: {{ $reservacion->codigo_reservacion }}">{{ $reservacion->codigo_reservacion }}</td>
                            <td aria-label="Nombre del cliente: {{ $reservacion->nombre }}">{{ $reservacion->nombre }}</td>
                            <td aria-label="Email del cliente: {{ $reservacion->email }}">{{ $reservacion->email }}</td>
                            <td aria-label="Teléfono del cliente: {{ $reservacion->telefono }}">{{ $reservacion->telefono }}</td>
                            <td aria-label="Fecha de entrada: {{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('d-m-Y') }}">{{ \Carbon\Carbon::parse($reservacion->fecha_entrada)->format('d-m-Y') }}</td>
                            <td aria-label="Fecha de salida: {{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('d-m-Y') }}">{{ \Carbon\Carbon::parse($reservacion->fecha_salida)->format('d-m-Y') }}</td>
                            <td aria-label="Tipo de la reservación: {{ ucfirst($reservacion->tipo_reservacion) }}">{{ ucfirst($reservacion->tipo_reservacion) }}</td>
                            <td aria-label="Monto total: ${{ number_format($reservacion->monto_total, 2) }}">${{ number_format($reservacion->monto_total, 2) }}</td>
                            <td aria-label="Método de pago: {{ ucfirst($reservacion->metodo_pago) }}">{{ ucfirst($reservacion->metodo_pago) }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="edit-button" aria-label="Editar esta reservación">Editar</a>
                                    <form action="{{ route('reservaciones.destroy', $reservacion->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta reservación?')">Borrar</button>
                                        <button type="submit" class="delete-button" aria-label="Borrar esta reservación">Borrar</button>
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
        input.addEventListener('input', () => {
            const textoIngresado = input.value;
            narrar(textoIngresado);
        });
    });
</script>

@endsection
