<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('password.update') }}" onsubmit="return validarFormulario()">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div>
                <x-label for="email" :value="__('Correo Electrónico')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                <span id="error-email" class="mensaje-error"></span>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus aria-label="Campo para ingresar el correo electrónico" />
            </div>

            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                <span id="error-password" class="mensaje-error"></span>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required aria-label="Campo para ingresar la nueva contraseña" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                <span id="error-confirm-password" class="mensaje-error"></span>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required aria-label="Campo para confirmar la nueva contraseña" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Restablecer Contraseña') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    <script>
        function validarFormulario() {
            let esValido = true;
            let errores = [];
            let email = document.getElementById('email').value;
            let password = document.getElementById('password').value;
            let confirmPassword = document.getElementById('password_confirmation').value;

            document.getElementById('error-email').textContent = '';
            document.getElementById('error-password').textContent = '';
            document.getElementById('error-confirm-password').textContent = '';

            if (!email.includes('@')) {
                errores.push('Por favor, introduce un correo electrónico válido.');
                document.getElementById('error-email').textContent = 'Por favor, introduce un correo electrónico válido.';
                esValido = false;
            }

            if (password.length < 8) {
                errores.push('La contraseña debe tener al menos 8 caracteres.');
                document.getElementById('error-password').textContent = 'La contraseña debe tener al menos 8 caracteres.';
                esValido = false;
            }

            if (password !== confirmPassword) {
                errores.push('Las contraseñas no coinciden.');
                document.getElementById('error-confirm-password').textContent = 'Las contraseñas no coinciden.';
                esValido = false;
            }

            if (errores.length > 0) {
                reproducirSonidoError();
                narrarErrores(errores);
            }

            return esValido;
        }

        function reproducirSonidoError() {
            let audio = new Audio('sonidos/error.mp3');
            audio.play();
        }

        function narrarErrores(errores) {
            const mensaje = errores.join('. ');
            const narrador = new SpeechSynthesisUtterance(mensaje);
            narrador.lang = 'es-ES';
            window.speechSynthesis.speak(narrador);
        }
    </script>

    <style>
        .mensaje-error {
            color: red;
            font-size: 0.9rem;
        }
    </style>
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
