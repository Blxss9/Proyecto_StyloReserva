

<!-- Vista de Crear Cuenta -->
<section class="h-screen flex">
    <!-- Imagen de fondo en el lado izquierdo -->
    <div class="hidden lg:flex w-1/2 bg-cover" style="background-image: url('/build/img/barberia2.jpg'); background-position: center;">
        <div class="bg-black opacity-20 w-full h-full"></div> <!-- Superposición oscura -->
    </div>

    <!-- Formulario en el lado derecho -->
    <div class="flex flex-col justify-center w-full lg:w-1/2 p-8 bg-gray-900 text-white relative">
        <!-- Botón de Home -->
        <div class="absolute top-4 right-4 transform -translate-x-1/2">
            <a href="/" class="flex items-center text-sm text-black bg-white px-2 py-1 rounded hover:bg-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24" stroke="none">
                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                </svg>
                Home
            </a>
        </div>

        <div class="w-full max-w-lg xl:max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 xl:px-10">
            <h2 class="text-4xl lg:text-5xl font-bold text-center mb-6">Crear Cuenta</h2>
            <p class="text-center text-gray-300 mb-8 text-sm lg:text-lg">Llena el siguiente formulario para crear una cuenta</p>

            <?php 
                include_once __DIR__ . "/../templates/alertas.php";
            ?>

            <!-- Formulario -->
            <form id="formCrearCuenta" action="/crear-cuenta" method="POST">
            
                <!-- Campo de Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-300 text-sm lg:text-base">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo s($usuario->nombre); ?>" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Campo de Apellido -->
                <div class="mb-4">
                    <label for="apellido" class="block text-gray-300 text-sm lg:text-base">Apellido</label>
                    <input type="text" id="apellido" name="apellido" placeholder="Tu Apellido" value="<?php echo s($usuario->apellido); ?>" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Campo de Teléfono -->
                <div class="mb-4">
                    <label for="telefono" class="block text-gray-300 text-sm lg:text-base">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" value="<?php echo s($usuario->telefono); ?>" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Campo de Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-300 text-sm lg:text-base">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo s($usuario->email); ?>" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Campo de Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-300 text-sm lg:text-base">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password" value="<?php echo s($usuario->password); ?>" class="w-full px-4 py-2 lg:py-3 rounded-md border border-gray-300 text-gray-900 focus:ring-2 focus:ring-blue-500" >
                </div>

                <!-- Botón de Crear Cuenta -->
                <button type="submit" class="w-full bg-blue-600 text-white py-2 lg:py-3 rounded-md font-semibold hover:bg-blue-700 transition-colors text-sm lg:text-lg">Crear Cuenta</button>
            </form>

            <!-- Botón de Iniciar Sesión con Google -->
            <button type="button" class="w-full mt-4 flex items-center justify-center bg-white text-gray-700 border border-gray-300 py-2 lg:py-3 rounded-md font-semibold hover:bg-gray-100 transition-all duration-300">
                <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google Logo" class="w-5 h-5 mr-2">
                Crear Cuenta con Google
            </button>

            <!-- Enlaces adicionales -->
            <div class="flex justify-between mt-6 text-gray-300 text-sm lg:text-base">
                <a href="/login" class="hover:underline hover:text-blue-400">¿Ya tienes una cuenta? Inicia Sesión</a>
                <a href="/olvide" class="hover:underline hover:text-blue-400">¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
</section>
