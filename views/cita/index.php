<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-4xl font-bold text-center mb-0 text-gray-800 animate-fade-in" value="<?php echo $nombre; ?>">
            ¡Bienvenido <?php echo $nombre; ?>!
        </h1>
        <h2 class="text-2xl font-medium text-center text-gray-600 mb-12 mt-2">
            Sigue los pasos para agendar tu cita
        </h2>
        

        <div id="app">
            <!-- Campos ocultos para ID y nombre del cliente -->
            <input type="hidden" id="id" value="<?php echo $_SESSION['id'] ?? ''; ?>">
            <input type="hidden" id="nombre" value="<?php echo $_SESSION['nombre'] ?? ''; ?>">
            
            <!-- Progress Bar -->
            <div class="mb-12">
                <div class="flex justify-between">
                    <div class="w-1/4 text-center relative">
                        <button data-paso="1" class="step-button w-12 h-12 rounded-full bg-blue-500 text-white font-bold mb-3 mx-auto transform hover:scale-105 transition-transform">1</button>
                        <span class="text-sm font-medium">Servicios</span>
                    </div>
                    <div class="w-1/4 text-center">
                        <button data-paso="2" class="step-button w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold mb-2 mx-auto">2</button>
                        <span class="text-sm">Fecha y Hora</span>
                    </div>
                    <div class="w-1/4 text-center">
                        <button data-paso="3" class="step-button w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold mb-2 mx-auto">3</button>
                        <span class="text-sm">Resumen</span>
                    </div>
                    <div class="w-1/4 text-center">
                        <button data-paso="4" class="step-button w-10 h-10 rounded-full bg-gray-300 text-gray-600 font-bold mb-2 mx-auto">4</button>
                        <span class="text-sm">Pago</span>
                    </div>
                </div>
                <div class="relative pt-4">
                    <div class="overflow-hidden h-3 mb-4 text-xs flex rounded-full bg-gray-200">
                        <div id="progress" class="w-1/4 shadow-lg flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-blue-500 to-blue-600 transition-all duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Secciones -->
            <!-- Seccion 1 Servicios     -->
            <div id="paso-1" class="seccion bg-white rounded-xl shadow-lg p-8 transform transition-all duration-300 hover:shadow-xl">
                <h2 class="text-2xl font-semibold mb-4 text-gray-800">Servicios Disponibles</h2>
                <p class="text-start text-gray-600 mb-8">Selecciona los servicios que deseas agendar</p>
                <div id="servicios" class="grid grid-cols-1 md:grid-cols-2 gap-6"></div>
            </div>

            <!-- Seccion 2 Fecha y Hora -->
            <div id="paso-2" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Fecha y Hora</h2>
                <p class="text-start text-gray-600 mb-6">Selecciona la fecha y hora de tu cita</p>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha">Fecha:</label>
                    <input type="date" id="fecha" class="w-full p-2 border rounded">
                </div>

                <div id="horas-disponibles" class="hidden">
                    <h3 class="text-xl font-semibold mb-4">Horas Disponibles:</h3>
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Mañana</h4>
                            <div id="horas-mañana" class="grid grid-cols-3 gap-2"></div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Tarde</h4>
                            <div id="horas-tarde" class="grid grid-cols-3 gap-2"></div>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-700 mb-2">Noche</h4>
                            <div id="horas-noche" class="grid grid-cols-3 gap-2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seccion 3 Resumen -->
            <div id="paso-3" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Resumen</h2>
                <p class="text-start text-gray-600 mb-6">Verifica que la información sea correcta</p>
                <div id="resumen-cita" class="space-y-4"></div>
            </div>

            <!-- Seccion 4 Pago -->
            <div id="paso-4" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Pago</h2>
                <p class="text-start text-gray-600 mb-6">Selecciona la como deseas pagar</p>
                <!-- Aquí irá el formulario de pago -->
            </div>

            <!-- Botones de navegación -->
            <div class="flex justify-between mt-8 gap-4">
                <button id="anterior" class="px-8 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all transform hover:-translate-x-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:transform-none">
                    &laquo; Anterior
                </button>
                <button id="siguiente" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all transform hover:translate-x-1 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:transform-none">
                    Siguiente &raquo;
                </button>
            </div>
        </div>
    </div>
</div>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='/build/js/app.js'></script>
    ";
?>