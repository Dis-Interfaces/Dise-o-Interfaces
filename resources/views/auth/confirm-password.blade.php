<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600" aria-label="Área segura de la aplicación. Confirma tu contraseña antes de continuar.">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 1000;"></div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}" id="password-confirm-form" onsubmit="return validateForm()">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" aria-label="Etiqueta para el campo de contraseña" />

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         required autocomplete="current-password" />
                         required autocomplete="current-password"
                         aria-label="Campo para ingresar la contraseña" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button aria-label="Botón para confirmar">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    <script>
        const errorSound = new Audio('error.mp3'); // Cambia el path por la ruta correcta de tu sonido.

        function validateForm() {
            const passwordInput = document.getElementById('password');
            const toastContainer = document.getElementById('toast-container');
            let hasError = false;

            clearToasts();

            if (passwordInput.value.trim() === '') {
                showToast('La contraseña es obligatoria.', 'fa-lock');
                hasError = true;
            } else if (passwordInput.value.length < 6) {
                showToast('La contraseña debe tener al menos 6 caracteres.', 'fa-lock');
                hasError = true;
            }

            if (hasError) {
                errorSound.play();
                return false;
            }

            return true;
        }

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
    </script>
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
