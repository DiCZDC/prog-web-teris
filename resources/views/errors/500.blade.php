<x-app-layout>
    <div class="flex items-center justify-center min-h-screen ">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-6xl font-bold text-purple-600 mb-4">500</h1>
            <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExbHlqOWVmbnc0dm5ob2E5Y3g1dTQxbXo4ajFpZTZpem80dW9sMzlvciZlcD12MV9naWZzX3NlYXJjaCZjdD1n/RfvBXK1m8Kcdq/giphy.gif" alt="Página no encontrada" class="mx-auto mb-6 w-48 h-48">
            <p class="text-xl text-gray-700 mb-6">Lo sentimos, ha ocurrido un error en el servidor.</p>
            <a href="{{ url('/') }}" class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-300">
                Volver al inicio
            </a>
        </div>
    </div>
</x-app-layout>