<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <!-- Botón de Home -->
    <div class="absolute top-6 left-1/2 transform -translate-x-1/2">
            <a href="/" class="flex items-center text-sm text-black bg-white px-2 py-1 rounded hover:bg-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Home
            </a>
        </div>

    <!-- Contenedor principal -->
    <div class="flex flex-col lg:flex-row w-full max-w-5xl lg:h-auto bg-gray-800 rounded-lg shadow-lg overflow-hidden lg:my-0 my-10">
        
        <!-- Imagen de fondo a la izquierda en pantallas grandes -->
        <div class="hidden lg:flex lg:w-1/2 bg-cover bg-center" style="background-image: url('https://reservoimg.s3.amazonaws.com/fotos_blog/fd1fb362-b_foto_blog.jpg'); min-height: 400px;">
            <!-- Imagen en pantalla completa para estética -->
        </div>
        
        <!-- Formulario de recuperación de contraseña -->
        <div class="w-full lg:w-1/2 p-8 lg:p-12 flex items-center justify-center bg-gray-800">
            <div class="w-full max-w-lg"> <!-- Cambié el max-w-md a max-w-lg para ampliar el formulario -->
                <h2 class="text-3xl font-bold text-white mb-2">Recuperar Contraseña</h2>
                <p class="text-gray-400 mb-6">Ingresa tu dirección de correo electrónico para recibir instrucciones para recuperar tu contraseña.</p>

                <!-- Formulario -->
                <form id="formRecuperarPassword" action="/recuperar-password" method="POST">
                    
                    <!-- Campo de Email -->
                    <label for="email" class="block text-gray-400 mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo" class="w-full px-4 py-2 mb-4 rounded bg-gray-200 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

                    <!-- Botón de Enviar Instrucciones -->
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded font-semibold hover:bg-blue-700 transition-colors">
                        Enviar Instrucciones
                    </button>
                </form>

                <!-- Enlaces adicionales para navegación -->
                <div class="flex justify-between mt-6 text-sm text-gray-400">
                    <a href="/login" class="hover:underline">¿Ya tienes una cuenta? Iniciar Sesión</a>
                    <a href="/crear-cuenta" class="hover:underline">¿No tienes cuenta? Regístrate</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Script opcional de FontAwesome para íconos si deseas agregar íconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
