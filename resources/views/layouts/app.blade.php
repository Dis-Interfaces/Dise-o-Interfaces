<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Formulario con Validaciones</title>
</head>
<body>

<!-- Formulario de ejemplo -->
<form id="registro-form">
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email">
    <br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password">
    <br>

    <label for="confirm-password">Confirmar Contraseña:</label>
    <input type="password" id="confirm-password" name="confirm-password">
    <br>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre">
    <br>

    <button type="submit">Registrar</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('registro-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir envío del formulario mientras validamos

        let errors = [];
        let hasError = false;

        // Validación de correo electrónico
        const emailInput = document.getElementById('email');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(emailInput.value)) {
            errors.push({ message: 'El correo electrónico no es válido.', icon: 'fa-envelope' });
            hasError = true;
        }

        // Validación de la contraseña
        const passwordInput = document.getElementById('password');
        if (passwordInput.value.length < 6) {
            errors.push({ message: 'La contraseña debe tener al menos 6 caracteres.', icon: 'fa-lock' });
            hasError = true;
        }

        // Validación de la confirmación de la contraseña
        const confirmPasswordInput = document.getElementById('confirm-password');
        if (passwordInput.value !== confirmPasswordInput.value) {
            errors.push({ message: 'Las contraseñas no coinciden.', icon: 'fa-exclamation-triangle' });
            hasError = true;
        }

        // Validación del campo de nombre
        const nombreInput = document.getElementById('nombre');
        if (nombreInput.value.trim() === "") {
            errors.push({ message: 'El nombre es obligatorio.', icon: 'fa-user' });
            hasError = true;
        }

        // Mostrar notificaciones de error
        if (hasError) {
            showErrorMessages(errors);
        } else {
            // Si no hay errores, puedes enviar el formulario o hacer alguna otra acción
            Swal.fire({
                title: 'Éxito',
                text: 'Formulario enviado correctamente.',
                icon: 'success',
                background: '#2e3b4e',
                customClass: {
                    title: 'swal-title',
                    input: 'swal-input'
                },
            });
        }
    });

    // Función para mostrar los mensajes de error
    function showErrorMessages(errors) {
        errors.forEach(error => {
            Swal.fire({
                title: 'Error',
                text: error.message,
                icon: 'error',
                background: '#2e3b4e',
                customClass: {
                    title: 'swal-title',
                    input: 'swal-input'
                },
                iconHtml: `<i class="fa ${error.icon}"></i>`, // Usar el icono especificado
            });
        });
    }
</script>

</body>
</html>
