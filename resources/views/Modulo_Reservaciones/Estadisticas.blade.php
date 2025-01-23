@extends('layouts.app')

@section('head.content')
    <title>Estadísticas de Habitaciones</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            color: #ffffff;
        }
        .board {
            margin: auto;
            width: 80%;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            width: 320px;
            height: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .chart-container {
            width: 206px;
            height: 206px;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .chart-percentage {
            position: absolute;
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }
        .chart-title {
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
        .neon-amber {
            color: #FFBF00;
            text-shadow: 0 0 5px #FFBF00, 0 0 10px #FFBF00, 0 0 20px #FFBF00;
        }
        .neon-pink {
            color: #FF00FF;
            text-shadow: 0 0 5px #FF00FF, 0 0 10px #FF00FF, 0 0 20px #FF00FF;
        }
        .neon-cyan {
            color: #00FFFF;
            text-shadow: 0 0 5px #00FFFF, 0 0 10px #00FFFF, 0 0 20px #00FFFF;
        }
        .btn-gestionar {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #444444;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-gestionar:hover {
            background-color: #ffffff;
            color: #111111;
            transform: scale(1.05);
        }
    </style>
@endsection

@section('main.content')
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif

        <div class="board">
            @foreach ($estadisticas as $id => $hotel)
                @php
                    $hotelNombres = [
                        1 => 'Hotel Sol',
                        2 => 'Hotel Luna',
                        3 => 'Hotel Estrella'
                    ];
                    $neonClases = [
                        1 => 'neon-amber',
                        2 => 'neon-pink',
                        3 => 'neon-cyan'
                    ];
                    $nombreHotel = $hotelNombres[$id] ?? 'Hotel Desconocido';
                    $neonClase = $neonClases[$id] ?? 'neon-amber';
                @endphp

                <div class="card">
                    <div class="chart-title {{ $neonClase }}">
                        {{ $nombreHotel }}
                    </div>
                    <div class="chart-container">
                        <canvas id="chart-{{ $id }}"></canvas>
                        <div class="chart-percentage">{{ $hotel['ocupacion'] }}%</div>
                    </div>
                    <a href="{{ route('ocupacion.index') }}" class="btn-gestionar">Gestionar habitaciones</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('body.content')
    <script>
        const estadisticas = @json($estadisticas);

        Object.keys(estadisticas).forEach(id => {
            const ctx = document.getElementById(`chart-${id}`).getContext('2d');
            const { ocupacion, disponibilidad } = estadisticas[id];
            const colors = {
                1: ['#FFBF00', '#292929'],
                2: ['#FF00FF', '#292929'],
                3: ['#00FFFF', '#292929'],
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Ocupación', 'Disponibilidad'],
                    datasets: [{
                        data: [ocupacion, disponibilidad],
                        backgroundColor: colors[id],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                }
            });
        });
    </script>
@endsection
