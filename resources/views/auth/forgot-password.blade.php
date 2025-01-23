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

        <form method="POST" action="{{ route('password.email') }}">
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
