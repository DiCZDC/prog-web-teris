<style>
    *{
        color: black;
    }
    body {
        background-color: #f0f2f5;
        font-family: Arial, sans-serif;
    }
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
    }
</style>
<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('events.store') }}">
                        @csrf
   

            <h1 class="text-2xl font-bold mb-6" style="color: black;">Crear Nuevo Evento</h1>
            <form method="POST" action="{{ route('events.store') }}">
                @csrf
                <!-- Campos del formulario para crear un evento -->
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Nombre del Evento</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Descripción</label>
                        <textarea name="description" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Enlace de la imagen</label>
                        <input type="text" name="image_url" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Fecha inicio</label>
                        <input type="date" name="inicio_evento" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Fecha fin</label>
                        <input type="date" name="fin_evento" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Modalidad</label>
                        <select name="modalidad" class="w-full border rounded px-3 py-2" required>
                            <option value="">Seleccione una modalidad</option>
                            <option value="Presencial">Presencial</option>
                            <option value="Virtual">Virtual</option>
                            <option value="Híbrido">Híbrido</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Ubicación (si aplica)</label>
                        <input type="text" name="ubicacion" class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Reglas</label>
                        <textarea name="reglas" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-2" style="color:black;">Premios</label>
                        <textarea name="premios" class="w-full border rounded px-3 py-2" rows="4"></textarea>
                    </div>
                <!-- Botón de envío -->
                <button  type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Guardar
                </button>
            </form>
   
</x-app-layout>