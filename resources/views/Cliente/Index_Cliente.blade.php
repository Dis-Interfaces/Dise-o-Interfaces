@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="customers_table"> 
        <section class="table__header">
            <h1>Clientes</h1>
            <div class="input-group">
                <input type="search" placeholder="Search Data..." aria-label="Buscar en la tabla de clientes">
            </div>
            <div class="top-bar">
                <a href="{{ route('clientes.create') }}" class="edit-button" aria-label="Enlace para añadir un nuevo cliente">Añadir Cliente</a>
            </div>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Nombre <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Apellidos <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Email <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Teléfono <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Dirección <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Acciones </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                    <tr>
                        <td aria-label="Nombre del cliente">{{ $cliente->nombre }}</td>
                        <td aria-label="Apellidos del cliente">{{ $cliente->apellidos }}</td> 
                        <td aria-label="Correo electrónico del cliente">{{ $cliente->email }}</td>
                        <td aria-label="Teléfono del cliente">{{ $cliente->telefono }}</td>
                        <td aria-label="Dirección del cliente">{{ $cliente->direccion }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('clientes.edit', $cliente->id) }}" class="edit-button" aria-label="Enlace para editar al cliente {{ $cliente->nombre }}">Editar</a>
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-button" aria-label="Botón para borrar al cliente {{ $cliente->nombre }}">Borrar</button>
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
</script>
@endsection
