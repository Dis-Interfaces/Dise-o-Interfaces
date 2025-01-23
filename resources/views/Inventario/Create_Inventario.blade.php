@extends('layouts.app')

@section('head.content')
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="{{ asset('/css/anadir.css') }}">
@endsection
 

@section('main.content')
    <div class="main-content"> 
        <h2>Registro de Producto</h2>

        <form action="{{ route('inventario.store') }}" method="POST">
            @csrf 

            <div class="input-group">
                <label for="nombre_producto">Producto:</label>
                <input type="text" id="nombre_producto" name="nombre_producto" required>
            </div>

            <div class="input-group">
                <label for="hotel_id">Hotel:</label>
                <select class="styled-select" id="hotel_id" name="hotel_id" required>
                    @foreach($hoteles as $hotel)
                        <option value="{{ $hotel->id }}">{{ $hotel->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="proveedor_id">Proveedor:</label>
                <select class="styled-select" id="proveedor_id" name="proveedor_id" required>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="input-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>

            <div class="input-group">
                <label for="precio">Precio:</label>
                <input type="number" step="0.01" min="0" id="precio" name="precio" required>
            </div>

            <div class="input-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" required>
            </div>

            <div class="button-group">
                <a href="{{ route('inventario.index') }}" class="cancel-button">Cancelar</a>
                <button type="submit" class="cancel-button">Registrar</button>
            </div>
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

@section('scripts')
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

    document.querySelectorAll('input, select').forEach(function(element) {
        element.addEventListener('input', function() {
            narrar(`Ingresando: ${this.value}`);
        });
    });
</script>
@endsection
