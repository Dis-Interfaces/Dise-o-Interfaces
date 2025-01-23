@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="ordenes_table">
        <section class="table__header">
            <h1>Ordenes de Compra</h1>
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Hotel <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Proveedor <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Producto <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Cantidad <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Precio Unitario <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Subtotal <span class="icon-arrow">&UpArrow;</span></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ordenesCompra as $orden)
                        <tr>
                            <td aria-label="ID de la orden: {{ $orden->id }}">{{ $orden->id }}</td>
                            <td aria-label="Hotel: {{ $orden->hotel->nombre }}">{{ $orden->hotel->nombre }}</td>
                            <td aria-label="Proveedor: {{ $orden->proveedor->nombre }}">{{ $orden->proveedor->nombre }}</td>
                            <td aria-label="Producto: {{ $orden->producto->nombre_producto }}">{{ $orden->producto->nombre_producto }}</td>
                            <td aria-label="Cantidad: {{ $orden->cantidad }}">{{ $orden->cantidad }}</td>
                            <td aria-label="Precio unitario: ${{ $orden->precio_unitario }}">{{ $orden->precio_unitario }}</td>
                            <td aria-label="Subtotal: ${{ $orden->subtotal }}">{{ $orden->subtotal }}</td>
                            <td>
                                <form action="{{ route('ordenes-compra.print', $orden->id) }}" method="GET" target="_blank">
                                    <button type="submit" class="restock-button" aria-label="Imprimir orden de compra ID {{ $orden->id }}">Imprimir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</div>
@endsection

@section('sidebar.content')
    <div class="sidebar-content">
        <a href="{{ route('inventario.index') }}" aria-label="Ir a la página de inventario">Stock</a>
    </div>

    <div class="sidebar-content active">
        <a href="{{ route('ordenes-compra.index') }}" aria-label="Ir a la página de órdenes de compra">Ordenes</a>
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
