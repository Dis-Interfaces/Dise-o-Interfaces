<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" aria-label="Logo de la aplicación" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600" aria-label="Instrucciones para restablecer la contraseña.">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" aria-label="Estado de la sesión" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" aria-label="Errores de validación" />

        <form method="POST" action="{{ route('password.email') }}" id="password-reset-form">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" aria-label="Etiqueta del campo de correo electrónico" />

                <x-input id="email" class="block mt-1 w-full"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required autofocus
                         aria-label="Campo para ingresar el correo electrónico" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button aria-label="Botón para enviar enlace de restablecimiento de contraseña">
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1000;"></div>

    <script>
        const errorSound = new Audio('/path/to/error.mp3'); // Cambia el path por la ruta correcta de tu sonido.

        // Validación del formulario
        document.getElementById('password-reset-form').addEventListener('submit', function(event) {
            let hasError = false;
            const errors = []; // Arreglo de errores

            const emailInput = document.getElementById('email');
            const toastContainer = document.getElementById('toast-container');

            clearToasts(); // Limpiar notificaciones previas

            // Validar que el correo electrónico no esté vacío
            if (emailInput.value.trim() === '') {
                errors.push({ message: 'El correo electrónico es obligatorio.', icon: 'fa-envelope' });
                hasError = true;
            }
            // Validar formato del correo electrónico
            else if (!validateEmail(emailInput.value)) {
                errors.push({ message: 'Por favor ingresa un correo electrónico válido.', icon: 'fa-envelope' });
                hasError = true;
            }

            // Mostrar errores
            if (hasError) {
                event.preventDefault();
                errors.forEach(error => {
                    showToast(error.message, error.icon);
                });
                errorSound.play();
            }
        });

        // Validar formato de correo electrónico
        function validateEmail(email) {
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return emailPattern.test(email);
        }

        // Mostrar notificaciones tipo toast
        function showToast(message, icon) {
            const toastContainer = document.getElementById('toast-container');

            const toast = document.createElement('div');
            toast.classList.add('toast');
            toast.style.cssText = `
                display: flex;
                align-items: center;
                padding: 10px 20px;
                background-color: #f44336;
                color: white;
                border-radius: 5px;
                margin-bottom: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            `;

            toast.innerHTML = `<i class="fas ${icon}" style="margin-right: 10px;"></i> ${message}`;
            toastContainer.appendChild(toast);

            narrateMessage(message);

            setTimeout(() => {
                toast.remove();
            }, 4000);
        }

        function narrateMessage(message) {
            window.speechSynthesis.cancel();
            const narration = new SpeechSynthesisUtterance(message);
            narration.lang = 'es-ES';
            const voices = window.speechSynthesis.getVoices();
            const selectedVoice = voices.find(voice => voice.lang === 'es-ES');
            if (selectedVoice) narration.voice = selectedVoice;
            window.speechSynthesis.speak(narration);
        }

        function clearToasts() {
            const toastContainer = document.getElementById('toast-container');
            while (toastContainer.firstChild) {
                toastContainer.removeChild(toastContainer.firstChild);
            }
        }
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
            input.addEventListener('input', (event) => {
                narrar(event.target.value);
            });
        });
    </script>
</x-guest-layout>
