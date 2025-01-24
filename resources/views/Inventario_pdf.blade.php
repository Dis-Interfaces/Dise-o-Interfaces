<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Disponible</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #000;
            margin-bottom: 20px;
        }

        .report-info {
            text-align: right;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #ffffff;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #000;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2; /* Light gray for odd rows */
        }

        tr:nth-child(even) {
            background-color: #ffffff; /* White for even rows */
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #e0e0e0; /* Light hover effect */
        }

        .empty-message {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="report-info">
        <p id="report-date" onload="narrateText('Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}')">
            Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
    </div>
    <h1 id="report-title" onclick="narrateText('Lista de Inventario')">Lista de Inventario</h1>
    
    <table>
        <thead>
            <tr>
                <th onclick="narrateText('Producto')">Producto</th>
                <th onclick="narrateText('Hotel')">Hotel</th>
                <th onclick="narrateText('Proveedor')">Proveedor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inventarios as $inventario)
                <tr>
                    <td onclick="narrateText('{{ $inventario->nombre_producto }}')">{{ $inventario->nombre_producto }}</td>
                    <td onclick="narrateText('{{ $inventario->hotel->nombre }}')">{{ $inventario->hotel->nombre }}</td>
                    <td onclick="narrateText('{{ $inventario->proveedor->nombre }}')">{{ $inventario->proveedor->nombre }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty-message" onclick="narrateText('No se encontró inventario con esos filtros')">
                        No se encontró inventario con esos filtros
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    <p style="text-align: right; margin-top: 10px;" onclick="narrateText('Total de resultados: {{ $inventarios->count() }}')">
        Total de resultados: {{ $inventarios->count() }}
    </p>

    <script>
        function narrateText(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(utterance);
        }
    </script>
</body>
</html>
