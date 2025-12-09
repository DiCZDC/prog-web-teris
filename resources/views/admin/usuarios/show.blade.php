<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Usuario - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Mismo navbar que en index -->
    
    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('admin.usuarios.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <i class="fas fa-arrow-left mr-2"></i> Volver a Usuarios
        </a>
        
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="fas fa-user-circle mr-3"></i>Detalles del Usuario
            </h1>
            
            <!-- Contenido de detalles -->
            <p>Vista de detalles para usuario ID: {{ $usuario->id ?? 'N/A' }}</p>
            <!-- Añade más detalles según necesites -->
        </div>
    </div>
</body>
</html>