<x-app-layout>
    <div class="flex items-center justify-center min-h-screen ">
        <div class="bg-white p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-6xl font-bold text-purple-600 mb-4">404</h1>
            <img src="https://mystickermania.com/cdn/stickers/85.png" alt="Página no encontrada" class="mx-auto mb-6 w-48 h-48">
            <p class="text-xl text-gray-700 mb-6">Lo sentimos, la página que buscas no se pudo encontrar.</p>
            <a href="{{ url('/') }}" class="inline-block bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-300">
                Volver al inicio
            </a>
        </div>
    </div>
</x-app-layout>