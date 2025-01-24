<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Personal</title>
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
            margin-bottom: 15px;
            font-size: 20px; /* Título más pequeño */
        }

        .report-info {
            text-align: right;
            font-size: 12px; /* Texto de reporte más pequeño */
            color: #555;
            margin-bottom: 15px;
        }

        .table-container {
            width: 100%;
            display: flex;
            justify-content: center;
        }

        table {
            width: 70%; /* Ancho reducido */
            max-width: 600px; /* Ancho máximo */
            border-collapse: collapse;
            border: 1px solid #ddd;
            background-color: #ffffff;
            margin-top: 10px;
            font-size: 12px; /* Texto dentro de la tabla más pequeño */
        }

        th, td {
            padding: 6px 8px; /* Padding reducido */
            text-align: left;
        }

        th {
            background-color: #000;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2; /* Gris claro para filas impares */
        }

        tr:nth-child(even) {
            background-color: #ffffff; /* Blanco para filas pares */
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background-color: #e0e0e0; /* Efecto hover ligero */
        }

        .empty-message {
            text-align: center;
            font-size: 14px; /* Texto del mensaje vacío reducido */
            color: #888;
        }
    </style>
</head>
<body>
    <div class="report-info">
        <p id="report-date" onclick="narrateText('Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}')">Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
    <h1 id="report-title" onclick="narrateText('Reporte de Personal')">Reporte de Personal</h1>
    <div class="table-container">
        <table>
            <thead>
            <tr>
                <th onclick="narrateText('Nombre')">Nombre</th>
                <th onclick="narrateText('Puesto')">Puesto</th>
                <th onclick="narrateText('Turno')">Turno</th>
                <th onclick="narrateText('Hotel')">Hotel</th>
                <th onclick="narrateText('Email')">Email</th>
                <th onclick="narrateText('Teléfono')">Teléfono</th>
                <th onclick="narrateText('Estado')">Estado</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($personal as $persona)
                <tr>
                    <td onclick="narrateText('{{ $persona->nombre }}')">{{ $persona->nombre }}</td>
                    <td onclick="narrateText('{{ $persona->puesto }}')">{{ $persona->puesto }}</td>
                    <td onclick="narrateText('{{ $persona->turno }}')">{{ $persona->turno }}</td>
                    <td onclick="narrateText('{{ $persona->hotel->nombre ?? 'N/A' }}')">{{ $persona->hotel->nombre ?? 'N/A' }}</td>
                    <td onclick="narrateText('{{ $persona->email }}')">{{ $persona->email }}</td>
                    <td onclick="narrateText('{{ $persona->telefono }}')">{{ $persona->telefono }}</td>
                    <td onclick="narrateText('{{ $persona->estado }}')">{{ $persona->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-message" onclick="narrateText('No se encontró personal con esos filtros')">No se encontró personal con esos filtros</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <p style="text-align: right; margin-top: 10px; font-size: 12px;" onclick="narrateText('Total de resultados: {{ $personal->count() }}')">Total de resultados: {{ $personal->count() }}</p>

    <script>
        // Function to narrate the text
        function narrateText(text) {
            const utterance = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(utterance);
        }
    </script>
</body>
</html>
