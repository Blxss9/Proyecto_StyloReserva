<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-3xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-center"value="<?php echo $nombre; ?>">Bienvenido <?php echo $nombre; ?></h1>
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-2">Crear Nueva Cita</h1>
        <p class="text-center text-gray-600 mb-8">Elige tus servicios y coloca tus datos</p>

        <div id="app">
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
            <div id="paso-1" class="seccion bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Servicios</h2>
                <p class="text-center text-gray-600 mb-6">Elige tus servicios a continuación</p>
                <div id="servicios" class="grid grid-cols-1 md:grid-cols-2 gap-4"></div>
            </div>

            <div id="paso-2" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Fecha y Hora</h2>
                <p class="text-center text-gray-600 mb-6">Selecciona la fecha y hora de tu cita</p>
                
                <form class="space-y-6">
                    
                    <div>
                        <label class="block text-gray-700 mb-2" for="fecha">Fecha</label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="fecha"
                            type="date"
                            min="<?php echo date('Y-m-d', strtotime('+1 day') ); ?>"
                        />
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2" for="hora">Hora</label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            id="hora"
                            type="time"
                        />
                    </div>
                    <input type="hidden" id="id" value="<?php echo $id; ?>" >
                </form>
            </div>

            <div id="paso-3" class="seccion hidden bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Resumen</h2>
                <p class="text-center text-gray-600 mb-6">Verifica que la información sea correcta</p>
                <div id="resumen-cita" class="space-y-4"></div>
            </div>

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