@extends('layouts.app')

@section('head.content')
    <title>Realizar reporte del inventario</title>
    <link rel="stylesheet" href="{{ asset('/css/reporte.css') }}">
@endsection


@section('main.content') 
<main class="main-content">
    <h2>Filtrar reporte</h2>

    <form  action="{{route('jesus')}}" method="GET" class="edit-form">
        @csrf
        <div class="input-group">
            <label for="hotel_id">Filtrar por Hotel</label>
            <select id="hotel_id" name="hotel_id" disabled aria-label="Filtrar por hotel">
                <option value="">Todos</option>
                @foreach ($hoteles as $hotel)
                    <option value="{{ $hotel->id }}">
                        {{ $hotel->nombre }}
                    </option>
                @endforeach
            </select>
            <input type="checkbox" id="filter_hotel" name="filter_hotel" aria-label="Activar filtro por hotel">
        </div>
    
        <div class="input-group">
            <label for="turno_id">Filtrar por Turno</label>
            <select id="turno_id" name="turno_id" disabled aria-label="Filtrar por turno">
                <option value="">Todos</option>
                <option value="Vespertino">Vespertino</option>
                <option value="Matutino">Matutino</option>
            </select>
            <input type="checkbox" id="filter_turno" name="filter_turno" aria-label="Activar filtro por turno">
        </div>
    
        <div class="button-group">
            <a href="{{ route('personal.index') }}" class="cancel-button" aria-label="Cancelar reporte">Cancelar</a>
            <button id="button" type="submit" class="cancel-button" aria-label="Generar reporte en PDF">Generar PDF</button>
        </div>
    </form>
    
    <script>
        const button = document.getElementById('button');
        button.style.display = 'none';

        function verificarCheckboxes() {
            const filterHotel = document.getElementById('filter_hotel').checked;
            const filterTurno = document.getElementById('filter_turno').checked;

            button.style.display = (filterHotel || filterTurno) ? 'block' : 'none';
        }

        document.getElementById('filter_hotel').addEventListener('change', function () {
            document.getElementById('hotel_id').disabled = !this.checked;
            verificarCheckboxes(); 
        });

        document.getElementById('filter_turno').addEventListener('change', function () {
            document.getElementById('turno_id').disabled = !this.checked;
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

        document.querySelectorAll('[aria-label]').forEach(elemento => {
            elemento.addEventListener('mouseover', () => {
                const descripcion = elemento.getAttribute('aria-label');
                narrar(descripcion);
            });
        });

        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', () => {
                const textoIngresado = input.value;
                narrar(textoIngresado);
            });
        });
    </script>
</main>
@endsection
