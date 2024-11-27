<script src="/build/js/admin.js" defer></script>


<div class="bg-gray-100 min-h-screen">
    <!-- Header del Panel -->
    <div class="bg-white shadow-md mb-8">
        <div class="max-w-7xl mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold text-gray-800">Panel de Administración</h1>
            <p class="text-gray-600">Bienvenido, <?php echo $nombre; ?></p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Tabs de Navegación -->
        <div class="mb-8 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button 
                    class="tab-btn border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm active" 
                    data-tab="citas">
                    Gestión de Citas
                </button>
                <button 
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" 
                    data-tab="servicios">
                    Gestión de Servicios
                </button>
                <button 
                    class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" 
                    data-tab="usuarios">
                    Gestión de Usuarios
                </button>
            </nav>
        </div>

        <!-- Contenido de las Tabs -->
        <div id="tab-contents">
            <!-- Tab Citas -->
            <div class="tab-content" id="citas-tab">
                <?php include __DIR__ . '/citas.php'; ?>
            </div>

            <!-- Tab Servicios -->
            <div class="tab-content hidden" id="servicios-tab">
                <?php include __DIR__ . '/servicios.php'; ?>
            </div>

            <!-- Tab Usuarios -->
            <div class="tab-content hidden" id="usuarios-tab">
                <?php include __DIR__ . '/usuarios.php'; ?>
            </div>
        </div>
    </div>
</div>
