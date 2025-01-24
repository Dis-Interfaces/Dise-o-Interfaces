@extends('layouts.app')

@section('main.content')
<div class="main-content">
    <h1 aria-label="Detalles de la reservación">Detalles de Reservación</h1>

    <h4 aria-label="Información general de la reservación">Información General</h4>
    <ul>
        <li aria-label="Cliente: {{ $reservacion->cliente->nombre }} {{ $reservacion->cliente->apellidos }}"><strong>Cliente:</strong> {{ $reservacion->cliente->nombre }} {{ $reservacion->cliente->apellidos }}</li>
        <li aria-label="Hotel: {{ $reservacion->hotel->nombre }}"><strong>Hotel:</strong> {{ $reservacion->hotel->nombre }}</li>
        <li aria-label="Tipo de reservación: {{ ucfirst($reservacion->tipo_reservacion) }}"><strong>Tipo de Reservación:</strong> {{ ucfirst($reservacion->tipo_reservacion) }}</li>
        <li aria-label="Fecha de entrada: {{ $reservacion->fecha_entrada }}"><strong>Fecha de Entrada:</strong> {{ $reservacion->fecha_entrada }}</li>
        <li aria-label="Fecha de salida: {{ $reservacion->fecha_salida }}"><strong>Fecha de Salida:</strong> {{ $reservacion->fecha_salida }}</li>
        <li aria-label="Noches: {{ $reservacion->noches }}"><strong>Noches:</strong> {{ $reservacion->noches }}</li>
        <li aria-label="Método de pago: {{ ucfirst($reservacion->metodo_pago) }}"><strong>Método de Pago:</strong> {{ ucfirst($reservacion->metodo_pago) }}</li>
    </ul>

    <h4 aria-label="Habitaciones asociadas a la reservación">Habitaciones</h4>
    <ul>
        @foreach ($reservacion->habitaciones as $habitacion)
            <li aria-label="Habitación {{ $habitacion->numero_habitacion }} - ${{ number_format($habitacion->tarifa, 2) }}">Habitación {{ $habitacion->numero_habitacion }} - ${{ number_format($habitacion->tarifa, 2) }}</li>
        @endforeach
    </ul>

    <h4 aria-label="Artículos adicionales asociados a la reservación">Artículos Adicionales</h4>
    <ul>
        @foreach ($reservacion->inventarios as $articulo)
            <li aria-label="{{ $articulo->nombre_producto }} (x{{ $articulo->pivot->cantidad }}) - ${{ number_format($articulo->pivot->subtotal, 2) }}">{{ $articulo->nombre_producto }} (x{{ $articulo->pivot->cantidad }}) - ${{ number_format($articulo->pivot->subtotal, 2) }}</li>
        @endforeach
    </ul>

    <h4 aria-label="Información de la promoción aplicada a la reservación">Promoción</h4>
    <p aria-label="Código promocional: {{ $reservacion->codigo_promocional ?? 'N/A' }}">
        <strong>Código:</strong> {{ $reservacion->codigo_promocional ?? 'N/A' }} <br>
        <strong>Descuento:</strong> {{ $reservacion->descuento_aplicado }}%
    </p>

    <h4 aria-label="Notas adicionales relacionadas con la reservación">Notas</h4>
    <p aria-label="{{ $reservacion->notas }}">{{ $reservacion->notas }}</p>

    <h4 aria-label="Monto total de la reservación">Monto Total</h4>
    <p aria-label="Monto total: ${{ number_format($reservacion->monto_total, 2) }}"><strong>${{ number_format($reservacion->monto_total, 2) }}</strong></p>

    <a href="{{ route('reservaciones.create') }}" class="btn btn-secondary" aria-label="Crear una nueva reservación">Crear otra Reservación</a>
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

    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => {
            const textoIngresado = input.value;
            narrar(textoIngresado);
        });
    });
</script>
@endsection
