@extends('layouts.app')

@section('head.content')
    <link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="habitacion_table">
        <section class="table__header">
            <h1>Lista de Habitaciones</h1>
            <div class="input-group">
                <input type="search" placeholder="Buscar...">
            </div>
            <a href="{{ route('estadisticas.habitaciones') }}" class="btn-estadisticas">
                <i class="fas fa-chart-line"></i> Ver Estadísticas
            </a>
            <div class="top-bar">
                <a href="{{ route('habitaciones.create') }}" class="edit-button">Nueva Habitación</a>
            </div>
        </section>

        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>ID <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Hotel <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Tipo <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Número <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Tarifa <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Estado <span class="icon-arrow">&UpArrow;</span></th>
                        <th>Piso <span class="icon-arrow">&UpArrow;</span></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($habitaciones as $habitacion)
                        <tr>
                            <td>{{ $habitacion->id }}</td>
                            <td>
                                @switch($habitacion->hotel_id)
                                    @case(1)
                                        Hotel Sol
                                        @break
                                    @case(2)
                                        Hotel Mar
                                        @break
                                    @case(3)
                                        Hotel Luna
                                        @break
                                    @default
                                        Hotel desconocido
                                @endswitch
                            </td>
                            <td>
                                @switch($habitacion->tipo_habitacion_id)
                                    @case(1)
                                        Suite
                                        @break
                                    @case(2)
                                        Suite de Lujo
                                        @break
                                    @case(3)
                                        Sencilla
                                        @break
                                    @case(4)
                                        Habitación con 4 camas
                                        @break
                                    @case(5)
                                        Habitación con 5 camas
                                        @break
                                    @default
                                        Tipo desconocido
                                @endswitch
                            </td>

                            <td>{{ $habitacion->numero_habitacion }}</td>
                            <td>${{ number_format($habitacion->tarifa, 2) }}</td>
                            <td>{{ ucfirst($habitacion->estado) }}</td>
                            <td>{{ $habitacion->piso }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="edit-button">Editar</a>
                                    <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">Borrar</button>
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
