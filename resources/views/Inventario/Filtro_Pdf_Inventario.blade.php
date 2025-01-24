@extends('layouts.app')

@section('head.content')
    <title>Realizar reporte del inventario</title>
    <link rel="stylesheet" href="{{ asset('/css/reporte.css') }}">
@endsection


@section('main.content') 
<main class="main-content">
    <h2>Filtrar reporte</h2>

    <form action="{{ route('generar') }}" method="GET" class="edit-form">
        @csrf
        <div class="input-group">
            <label for="hotel_id">Filtrar por Hotel</label>
            <select id="hotel_id" name="hotel_id" disabled>
                <option value="">Todos</option>
                @foreach ($hoteles as $hotel)
                    <option value="{{ $hotel->id }}">
                        {{ $hotel->nombre }}
                    </option>
                @endforeach
            </select>
            <input type="checkbox" id="filter_hotel" name="filter_hotel">
        </div>
    
        <div class="input-group">
            <label for="proveedor_id">Filtrar por Proveedor</label>
            <select id="proveedor_id" name="proveedor_id" disabled>
                <option value="">Todos</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
            <input type="checkbox" id="filter_proveedor" name="filter_proveedor">
        </div>
    
        <div class="button-group">
            <a href="{{ route('inventario.index') }}" class="cancel-button">Cancelar</a>
            <button id="button" type="submit" class="cancel-button">Generar PDF</button>
        </div>    
    </form>

    <script>
        const button = document.getElementById('button');
        button.style.display = 'none';

        function verificarCheckboxes() {
            const filterHotel = document.getElementById('filter_hotel').checked;
            const filterTurno = document.getElementById('filter_proveedor').checked;

            button.style.display = (filterHotel || filterTurno) ? 'block' : 'none';
        }

        document.getElementById('filter_hotel').addEventListener('change', function () {
            document.getElementById('hotel_id').disabled = !this.checked;
            verificarCheckboxes(); 
        });

        document.getElementById('filter_proveedor').addEventListener('change', function () {
            document.getElementById('proveedor_id').disabled = !this.checked;
            verificarCheckboxes(); 
        });

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

        document.querySelectorAll('input, select').forEach(function(element) {
            element.addEventListener('input', function() {
                narrar(`Ingresando: ${this.value}`);
            });
        });
    </script>
</main>
@endsection

@section('sidebar.content')
    <div class="sidebar-content" class="active">
        <a href="{{ route('inventario.index') }}">
                Stock
        </a>
    </div>

    <div class="sidebar-content">
    <a href="{{ route('ordenes-compra.index') }}">
        Ordenes
        </a>
    </div>    
@endsection
