@extends('layouts.app')
@section('main.content')
<style>
   
.container {
    width: 100%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-y: auto; 
}

.hotel-bloques {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* Center all hotel-bloques */
    gap: 20px;
    width: 100%;
}

.hotel-bloque {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* Default alignment for other hotel-bloques */
    width: 48%; /* Adjust this width as needed */
    border: 2px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    box-sizing: border-box;
}

.hotel-bloque h2{
    align-items: center;
    margin: 0 auto; 
}

.hotel-bloque:last-child {
    align-items: center;
    margin: 0 auto; 
}

.habitaciones {
    display: flex; /* Changed to flex for centering */
    justify-content: center; /* Center the habitaciones */
    flex-wrap: wrap; /* Allow wrapping */
    gap: 5px;
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
}

.habitacion {
    display: flex;
    justify-content: center;
    align-items: center;
    aspect-ratio: 1 / 1;
    border-radius: 4px;
    color: #fff;
    font-weight: bold;
    font-size: 1.2em;
    text-align: center;
    width: 70px; /* Set a fixed width */
    height: 70px; /* Set a fixed height */
}

.habitacion.disponible {
    background-color: #28a745;
}

.habitacion.ocupada {
    background-color: #dc3545;
}

.habitacion.mantenimiento {
    background-color: #ffc107;
}

.input-group {
    margin-left: 50vh;
    font-size: 20px;
    padding-bottom: 20px;
    display: flex;
    align-items: center;
    width: 50%;
}

.input-group input[type="checkbox"] {
    margin-left: 20px; 
    transform: scale(1.5); 
    cursor: pointer; 
    width: 25px; 
    height: 25px; 
}

.input-group input[type="checkbox"]:checked {
    accent-color: rgb(98, 0, 255);
}

.input-group label {
    font-weight: bold;
    color: aliceblue;
    margin-right: 10px; 
}

.input-group select {
    width: auto; 
    flex-grow: 1; 
    padding: 8px; 
    border: 2px solid slateblue;
    border-radius: 5px;
    font-size: 1em;
    color: black;
    background-color: aliceblue;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.input-group input:focus,
.input-group select:focus {
    border-color: rgb(98, 0, 255);
    outline: none;
    box-shadow: 0 0 8px rgba(39, 1, 143, 0.4);
}

</style>
@section('main.content')
    <div class="container">
        <br><br>
        <h1>Mapa de Ocupación de Habitaciones</h1>

        <!-- Campo de selección de piso con narrador -->
        <div style="width: 60%; display: flex; justify-content: flex-end; margin-bottom: 20px;" class="input-group">
            <form method="GET" action="{{ route('ocupacion.index') }}">
                <label for="piso">Piso:</label>
                <select name="piso" id="piso" onchange="this.form.submit()" aria-label="Seleccione un piso">
                    <option value="" {{ request('piso') == '' ? 'selected' : '' }}>Todos</option>
                    <option value="1" {{ request('piso') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ request('piso') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ request('piso') == '3' ? 'selected' : '' }}>3</option>
                </select>
            </form>
        </div>

        <div class="hotel-bloques">
            @foreach($habitacionesPorHotel as $hotelId => $habitaciones)
                <div class="hotel-bloque">
                    <h2>
                        @switch($hotelId)
                            @case(1)
                                Hotel Sol
                                @break
                            @case(2)
                                Hotel Luna
                                @break
                            @case(3)
                                Hotel Estrella
                                @break
                            @default
                                Hotel Desconocido
                        @endswitch
                    </h2>

                    <div class="habitaciones">
                        @foreach($habitaciones as $habitacion)
                            <div class="habitacion {{ strtolower($habitacion->estado) }}" aria-label="Habitación número {{ $habitacion->numero_habitacion }} - Estado: {{ ucfirst($habitacion->estado) }}">
                                {{ $habitacion->numero_habitacion }}
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Agregamos el script para narrar -->
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

        document.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', () => {
                const textoIngresado = input.value;
                narrar(textoIngresado);
            });
        });
    </script>
@endsection
