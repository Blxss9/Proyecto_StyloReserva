<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center"value="<?php echo $nombre; ?>">Bienvenido <?php echo $nombre; ?></h1>
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">Crear Nueva Cita</h1>
        <p class="text-center text-gray-600 mb-8">Elige tus servicios y coloca tus datos</p>

        <div id="app">
            <!-- Campos ocultos para ID y nombre del cliente -->
            <input type="hidden" id="id" value="<?php echo $_SESSION['id'] ?? ''; ?>">
            <input type="hidden" id="nombre" value="<?php echo $_SESSION['nombre'] ?? ''; ?>">
            
            <!-- Progress Bar -->
            <div class="mb-8">
                <div class="flex justify-between">
                    <div class="w-1/4 text-center">
                        <button data-paso="1" class="step-button w-10 h-10 rounded-full bg-blue-500 text-white font-bold mb-2 mx-auto">1</button>
                        <span class="text-sm">Servicios</span>
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
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                        <div id="progress" class="w-1/4 shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500 transition-all duration-500"></div>
                    </div>
                </div>
            </div>

            <!-- Secciones -->
            <!-- Seccion 1 Servicios     -->
            <div id="paso-1" class="seccion bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Servicios</h2>
                <p class="text-center text-gray-600 mb-6">Elige tus servicios a continuación</p>
                <div id="servicios" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
            </div>

            <!-- Seccion 2 Fecha y Hora -->
            <div id="paso-2" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Fecha y Hora</h2>
                <p class="text-center text-gray-600 mb-6">Selecciona la fecha y hora de tu cita</p>
                
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
                <p class="text-center text-gray-600 mb-6">Verifica que la información sea correcta</p>
                <div id="resumen-cita" class="space-y-4"></div>
            </div>

            <!-- Seccion 4 Pago -->
            <div id="paso-4" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Pago</h2>
                <p class="text-center text-gray-600 mb-6">Realiza el pago de tu cita</p>
                <!-- Aquí irá el formulario de pago -->
            </div>

            <!-- Botones de navegación -->
            <div class="flex justify-between mt-6">
                <button id="anterior" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    &laquo; Anterior
                </button>
                <button id="siguiente" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
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