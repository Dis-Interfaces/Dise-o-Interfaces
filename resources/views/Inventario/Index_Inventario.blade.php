@extends('layouts.app')

@section('head.content')
<link rel="stylesheet" href="{{ asset('css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="customers_table">
        <section class="table__header">
            <h1>Inventario</h1>
            <div class="input-group">
                <input type="search" placeholder="Buscar..." id="searchInput">
            </div>

            <div class="top-bar">
                <a href="{{ route('inventario.create') }}" class="edit-button">Añadir Item</a>
            </div>

            <div class="top-bar">
                <a href="{{ route('pdf') }}" class="delete-button">Generar Reporte</a>
            </div>
            
        </section>
        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th> Nombre Producto <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Hotel <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Proveedor <span class="icon-arrow">&UpArrow;</span></th>
                        <th> Cantidad <span class="icon-arrow">&UpArrow;</span></th>
                        <th></th>
                        <th> Descripción <span class="icon-arrow">&UpArrow;</span></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventarios as $inventario)
                    <tr id="inventario-{{ $inventario->id_producto }}">
                        <td>{{ $inventario->nombre_producto }}</td>
                        <td>{{ $inventario->hotel->nombre }}</td>
                        <td>{{ $inventario->proveedor->nombre }}</td>
                        <td class="cantidad">{{ $inventario->cantidad }}</td>
                        <td> 
                            <button class="decrement-button" data-id="{{ $inventario->id_producto }}">➖</button>
                        </td>
                        <td>{{ $inventario->descripcion }}</td>
                        <td>
                            <div class="action-buttons">
                                <button class="restock-button" data-id="{{ $inventario->id_producto }}" data-price="{{ $inventario->precio }}">Restock</button>
                                <a href="{{ route('inventario.edit', ['inventario' => $inventario->id_producto]) }}" class="edit-button">Editar</a>
                                <form action="{{ route('inventario.destroy', $inventario->id_producto) }}" method="POST" class="delete-form">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    document.getElementById('searchInput').addEventListener('input', function () {
        narrar(`Buscando: ${this.value}`);
    });

    document.querySelectorAll('.decrement-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/inventario/decrement/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.querySelector(`#inventario-${id} .cantidad`).textContent = data.cantidad;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        });
    });

    document.querySelectorAll('.restock-button').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const price = this.getAttribute('data-price');
            Swal.fire({
                title: 'Cantidad a Comprar:',
                input: 'number',
                inputAttributes: {
                    min: 1,
                    step: 1
                },
                showCancelButton: true,
                confirmButtonText: 'Comprar',
                showLoaderOnConfirm: true,
                background: '#2e3b4e',
                customClass: {
                    title: 'swal-title',
                    input: 'swal-input'
                },
                preConfirm: (quantity) => {
                    if (quantity && !isNaN(quantity) && quantity > 0) {
                        return fetch(`/inventario/restock/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ quantity, price })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                throw new Error(data.error);
                            }
                            document.querySelector(`#inventario-${id} .cantidad`).textContent = data.cantidad;
                            return data;
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        });
                    } else {
                        Swal.showValidationMessage('Ingresa una cantidad válida.');
                    }
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Orden de compra generada",
                        icon: "success",
                        background: '#2e3b4e',
                        customClass: {
                            title: 'swal-title',
                            input: 'swal-input'
                        }
                    });
                }
            });
        });
    });
</script>

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
