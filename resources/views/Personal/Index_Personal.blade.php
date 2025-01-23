@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="personal_table">
        <section class="table__header">
            <h1>Lista de Personal</h1>
            <div class="input-group">
                <input type="search" placeholder="Buscar..." aria-label="Buscar personal">
            </div>
            <div class="top-bar">
                <a href="{{ route('personal.create') }}" class="edit-button" aria-label="Añadir nuevo personal">Añadir Personal</a>
            </div>

            <div class="top-bar">
                <a href="{{ route('pedro') }}" class="delete-button" aria-label="Generar reporte de personal">Generar Reporte</a>
            </div>
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>Nombre <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Apellidos <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Puesto <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Turno <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Teléfono <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Hora Entrada <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Hora Salida <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Área Asignada <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Hotel <span class="icon-arrow">&UpArrow;</span></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trabajadores as $trabajador)
                        <tr>
                            <td>{{ $trabajador->nombre }}</td>
                            <td>{{ $trabajador->apellidos }}</td>
                            <td>{{ $trabajador->puesto }}</td>
                            <td>{{ $trabajador->turno }}</td>
                            <td>{{ $trabajador->telefono }}</td>
                            <td>{{ $trabajador->hora_entrada ? $trabajador->hora_entrada->format('H:i') : 'No disponible' }}</td>
                            <td>{{ $trabajador->hora_salida ? $trabajador->hora_salida->format('H:i') : 'No disponible' }}</td>
                            <td>{{ $trabajador->area_asignada }}</td>
                            <td>{{ $trabajador->hotel->nombre ?? 'No asignado' }}</td> 
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('personal.edit', $trabajador->id) }}" class="edit-button" aria-label="Editar datos del personal {{ $trabajador->nombre }}">Editar</a>
                                    <form action="{{ route('personal.destroy', $trabajador->id) }}" method="POST" style="display:inline;" aria-label="Eliminar personal {{ $trabajador->nombre }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" aria-label="Confirmar eliminación de {{ $trabajador->nombre }}">Borrar</button>
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
