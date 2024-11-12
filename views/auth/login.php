<!-- Vista de Login -->
<section class="h-screen flex">
    <!-- Imagen de fondo en el lado izquierdo -->
    <div class="hidden lg:flex w-1/2 bg-cover" style="background-image: url('/build/img/barber-background.jpg');">
        <div class="bg-black opacity-50 w-full h-full"></div> <!-- Superposición oscura -->
    </div>

    <!-- Formulario de Login en el lado derecho -->
    <div class="flex flex-col justify-center w-full lg:w-1/2 p-8 bg-gray-900 text-white relative">
        <!-- Botón de Home -->
        <div class="absolute top-6 left-1/2 transform -translate-x-1/2">
            <a href="/" class="flex items-center text-sm text-black bg-white px-2 py-1 rounded hover:bg-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Home
            </a>
        </div>

        <div class="w-full max-w-md mx-auto px-4 sm:px-6 lg:px-8 xl:px-10">
            <h2 class="text-4xl lg:text-5xl font-bold text-center mb-6">Iniciar Sesión</h2>
            <p class="text-center text-gray-300 mb-8 text-sm lg:text-lg">Bienvenido, ingresa tus datos para continuar</p>

            <!-- Formulario de Login -->
            <form id="formLogin" action="/login" method="POST">
                <!-- Campo de Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm lg:text-base">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Tu correo electrónico" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Campo de Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 text-sm lg:text-base">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <!-- Olvidé mi contraseña -->
                <div class="flex items-center justify-end mb-6">
                    <a href="/olvide" class="text-sm text-blue-500 hover:underline">¿Olvidaste tu contraseña?</a>
                </div>

                <!-- Botón de Login -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 lg:py-3 rounded-md font-semibold hover:bg-blue-700 transition-colors text-sm lg:text-lg">Login</button>
            </form>

            <!-- Enlaces adicionales -->
            <div class="flex justify-between mt-6 text-gray-300 text-sm lg:text-base">
                <a href="/crear-cuenta" class="hover:underline">¿No tienes una cuenta? Crear Cuenta</a>
            </div>
        </div>
    </div>
</section>


