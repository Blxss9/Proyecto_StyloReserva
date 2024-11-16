<section class="min-h-screen flex items-center justify-center bg-gray-900 px-6">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden lg:flex lg:max-w-4xl w-full">
        <!-- Imagen del lado izquierdo -->
        <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image: url('https://via.placeholder.com/400');"></div>

        <!-- Formulario del lado derecho -->
        <div class="w-full p-6 sm:p-12 lg:w-1/2">
            <h2 class="text-2xl font-bold mb-6">Recuperar Contraseña</h2>
            <p class="text-sm text-gray-400 mb-6">Ingresa tu nueva contraseña a continuacion.</p>
            
            <form id="formRecuperarPassword"  method="POST">
                    <?php 
                        include_once __DIR__ . "/../templates/alertas.php";
                    ?>

                <?php if($error) return;?>

                <!-- Campo password -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium mb-1">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu Contraseña" 
                        class="w-full px-4 py-2 border rounded-md bg-gray-700 border-gray-600 text-gray-300 focus:outline-none focus:ring focus:ring-blue-500">
                </div>

                <!-- Botón Enviar -->
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition">
                    Guardar nueva contraseña 
                </button>
            </form>

            <!-- Enlaces adicionales -->
            <div class="mt-6 flex justify-between text-sm text-gray-400">
                <a href="/login" class="hover:underline hover:text-blue-500">¿Ya tienes cuenta? Inicia Sesión</a>
                <a href="/crear-cuenta" class="hover:underline hover:text-blue-500">¿No tienes cuenta? Regístrate</a>
            </div>
        </div>
    </div>
</section>
