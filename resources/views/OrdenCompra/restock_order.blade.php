<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.6; 
            color: #333; 
            background-color: #f8f9fa; 
            margin: 0; 
            padding: 0; 
        }
        .header { 
            text-align: center; 
            padding: 20px 0; 
            background-color: #4CAF50; 
            color: white; 
            margin-bottom: 20px; 
        }
        .header h1 { 
            margin: 0; 
            font-size: 24px; 
        }
        .content { 
            margin: 20px auto; 
            padding: 20px; 
            background: white; 
            max-width: 800px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
        }
        .content h2 { 
            margin-bottom: 10px; 
            color: #4CAF50; 
            border-bottom: 1px solid #ddd; 
            padding-bottom: 5px; 
            font-size: 18px; 
        }
        .content p { 
            margin: 5px 0; 
            font-size: 14px; 
        }
        .content p strong { 
            color: #555; 
        }
        .content p:last-child { 
            margin-bottom: 0; 
        }
        .table-section { 
            margin-top: 15px; 
            border-collapse: collapse; 
            width: 100%; 
        }
        .table-section th, .table-section td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        .table-section th { 
            background-color: #4CAF50; 
            color: white; 
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Orden de Compra</h1>
    </div>
    <div class="content">
        <h2>Información del Producto</h2>
        <p aria-label="Fecha del reporte: {{ \Carbon\Carbon::now()->format('d/m/Y') }}">
            <strong>Fecha del reporte:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}
        </p>
        <p aria-label="Producto: {{ $orden->producto->nombre_producto }}">
            <strong>Producto:</strong> {{ $orden->producto->nombre_producto }}
        </p>
        <p aria-label="Descripción: {{ $orden->producto->descripcion }}">
            <strong>Descripción:</strong> {{ $orden->producto->descripcion }}
        </p>
        <p aria-label="Cantidad: {{ $quantity }}">
            <strong>Cantidad:</strong> {{ $quantity }}
        </p>
        <p aria-label="Precio Por Unidad: ${{ $price }}">
            <strong>Precio Por Unidad:</strong> ${{ $price }}
        </p>
        <p aria-label="Precio Total: ${{ $totalPrice }}">
            <strong>Precio Total:</strong> ${{ $totalPrice }}
        </p>

        <h2>Información del Proveedor</h2>
        <p aria-label="Nombre del Proveedor: {{ $orden->proveedor->nombre }}">
            <strong>Nombre del Proveedor:</strong> {{ $orden->proveedor->nombre }}
        </p>
        <p aria-label="Contacto: {{ $orden->proveedor->telefono }}">
            <strong>Contacto:</strong> {{ $orden->proveedor->telefono }}
        </p>
        <p aria-label="Envío en: {{ $orden->proveedor->tiempo_reabastecimiento }} días">
            <strong>Envío en:</strong> {{ $orden->proveedor->tiempo_reabastecimiento }} días
        </p>

        <h2>Información del Hotel</h2>
        <p aria-label="Nombre del Hotel: {{ $orden->hotel->nombre }}">
            <strong>Nombre del Hotel:</strong> {{ $orden->hotel->nombre }}
        </p>
        <p aria-label="Dirección: {{ $orden->hotel->direccion }}">
            <strong>Dirección:</strong> {{ $orden->hotel->direccion }}
        </p>
    </div>

    <!-- Script para narrar -->
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
</body>

</html>
