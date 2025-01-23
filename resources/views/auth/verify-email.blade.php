<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('¡Gracias por registrarte! Antes de comenzar, verifica tu dirección de correo electrónico haciendo clic en el enlace que te enviamos. Si no recibiste el correo, con gusto te enviaremos otro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div id="notification" class="mb-4 font-medium text-sm text-green-600 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m1 4a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Reenviar correo de verificación') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>
        </div>
    </x-auth-card>

    <script>
        // Narrar automáticamente los mensajes de notificación
        document.addEventListener('DOMContentLoaded', () => {
            const notification = document.getElementById('notification');
            if (notification) {
                narrar(notification.textContent.trim());
            }
        });

        function narrar(texto) {
            const narrador = new SpeechSynthesisUtterance(texto);
            narrador.lang = 'es-ES'; // Idioma español
            window.speechSynthesis.cancel(); // Cancelar cualquier narración anterior
            window.speechSynthesis.speak(narrador); // Iniciar narración
        }
    </script>

    <style>
        #notification {
            background-color: #d4edda;
            border-left: 5px solid #28a745;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            font-size: 0.9rem;
        }
    </style>
</x-guest-layout>
