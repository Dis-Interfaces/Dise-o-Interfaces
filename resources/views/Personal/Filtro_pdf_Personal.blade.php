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

            <a href="{{ route('personal.index') }}" class="cancel-button">Cancelar</a>
            <button id="button" type="submit" class="cancel-button">Generar PDF</button>
        </div>
    </form>

    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.onload = function () {
            Swal.fire({
                icon: 'error',
                title: 'Errores encontrados',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonText: 'Entendido'
            }).then(() => {
                const errorMessage = `{!! implode(', ', $errors->all()) !!}`;
                const speech = new SpeechSynthesisUtterance(`Se encontraron los siguientes errores: ${errorMessage}`);
                speech.lang = 'es-ES';
                speech.volume = 1;
                speech.rate = 1;
                speech.pitch = 1;
                window.speechSynthesis.speak(speech);
            });
        };
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
            const hotelSelect = document.getElementById('hotel_id');
            hotelSelect.disabled = !this.checked;

            if (this.checked) {
                Swal.fire({
                    icon: 'info',
                    title: 'Filtro de Hotel Activado',
                    text: 'Ahora puedes seleccionar un hotel para filtrar el reporte.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Filtro de Hotel Activado. Ahora puedes seleccionar un hotel para filtrar el reporte.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Filtro de Hotel Desactivado',
                    text: 'El filtro de hotel ha sido desactivado. Se incluirán todos los hoteles en el reporte.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Filtro de Hotel Desactivado. Se incluirán todos los hoteles en el reporte.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            }
            verificarCheckboxes();
        });

        document.getElementById('filter_turno').addEventListener('change', function () {
            const turnoSelect = document.getElementById('turno_id');
            turnoSelect.disabled = !this.checked;

            if (this.checked) {
                Swal.fire({
                    icon: 'info',
                    title: 'Filtro de Turno Activado',
                    text: 'Ahora puedes seleccionar un turno para filtrar el reporte.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Filtro de Turno Activado. Ahora puedes seleccionar un turno para filtrar el reporte.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Filtro de Turno Desactivado',
                    text: 'El filtro de turno ha sido desactivado. Se incluirán todos los turnos en el reporte.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Filtro de Turno Desactivado. Se incluirán todos los turnos en el reporte.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            }
            verificarCheckboxes();
        });

        button.addEventListener('click', function (event) {
            const filterHotel = document.getElementById('filter_hotel').checked;
            const filterTurno = document.getElementById('filter_turno').checked;

            if (!filterHotel && !filterTurno) {
                event.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'No se seleccionaron filtros',
                    text: 'Debes activar al menos un filtro para generar el reporte.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('No se seleccionaron filtros. Debes activar al menos un filtro para generar el reporte.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Reporte generado',
                    text: 'Tu reporte está siendo generado con los filtros seleccionados.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Reporte generado. Tu reporte está siendo generado con los filtros seleccionados.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            }
        });

        // Validación en caso de datos incorrectos ingresados
        const form = document.querySelector('.edit-form');
        form.addEventListener('submit', function (event) {
            const hotelSelect = document.getElementById('hotel_id');
            const turnoSelect = document.getElementById('turno_id');

            if (hotelSelect.value === '' && document.getElementById('filter_hotel').checked) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el filtro de Hotel',
                    text: 'Debes seleccionar un hotel válido si el filtro está activado.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Error en el filtro de Hotel. Debes seleccionar un hotel válido si el filtro está activado.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            }

            if (turnoSelect.value === '' && document.getElementById('filter_turno').checked) {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error en el filtro de Turno',
                    text: 'Debes seleccionar un turno válido si el filtro está activado.'
                }).then(() => {
                    const speech = new SpeechSynthesisUtterance('Error en el filtro de Turno. Debes seleccionar un turno válido si el filtro está activado.');
                    speech.lang = 'es-ES';
                    speech.volume = 1;
                    speech.rate = 1;
                    speech.pitch = 1;
                    window.speechSynthesis.speak(speech);
                });
            }
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
