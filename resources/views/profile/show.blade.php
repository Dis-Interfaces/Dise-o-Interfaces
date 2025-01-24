@extends('layouts.app')

@section('head.content')
    <title>Perfil</title>
    <link rel="stylesheet" href="{{ asset('/css/listado.css') }}">
@endsection

@section('main.content')
<div class="main-content">
    <main class="table" id="personal_table">
        <section class="table__header">
            <h1>Tu Informacion</h1>
        </section>

        <section class="table__body">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Puesto</th>
                        <th>Turno</th>
                        <th>Fecha Ingreso</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Área Asignada</th>
                        <th>Tarea Asignada</th>
                        <th>Hotel</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $trabajador->nombre }}</td>
                        <td>{{ $trabajador->apellidos }}</td>
                        <td>{{ $trabajador->email }}</td>
                        <td>{{ $trabajador->puesto }}</td>
                        <td>{{ $trabajador->turno }}</td>
                        <td>{{ $trabajador->fecha_ingreso }}</td>
                        <td>{{ $trabajador->telefono }}</td>
                        <td>{{ $trabajador->direccion }}</td>
                        <td>{{ $trabajador->hora_entrada->format('H:i') }}</td>  
                        <td>{{ $trabajador->hora_salida->format('H:i') }}</td>   
                        <td>{{ $trabajador->area_asignada }}</td>
                        <td>{{ $trabajador->tarea_asignada }}</td>
                        <td>{{ $trabajador->hotel->nombre ?? 'No asignado' }}</td> 
                        <td>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <div class="action-buttons" id="profile">
        <div class="top-bar">
            <a href="#" class="edit-button">Editar Informacion</a>
        </div>

        <div class="top-bar">
            <a href="#" class="delete-button">Cambiar Contraseña</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function speakText(text) {
            const speech = new SpeechSynthesisUtterance(text);
            speech.lang = 'es-ES'; 
            window.speechSynthesis.speak(speech);
        }

        document.querySelectorAll('input, textarea').forEach((input) => {
            input.addEventListener('focus', function () {
                speakText('Ahora puedes ingresar en el campo ' + input.name);
            });

            input.addEventListener('input', function () {
                speakText('Estás escribiendo: ' + input.value);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            speakText("Bienvenido, aquí está la información de tu perfil");
        });
    </script>
@endsection
