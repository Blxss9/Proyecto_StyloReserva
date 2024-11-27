<h1 class="text-4xl font-bold text-center mb-10">Panel de Administración</h1>

<div class="flex flex-col md:flex-row items-center md:items-start gap-5 px-5">
    <!-- Buscador -->
    <div class="w-full md:w-1/3 lg:w-1/4">
        <form class="mb-4">
            <div class="flex gap-2">
                <input 
                    type="text" 
                    name="buscar" 
                    class="w-full rounded-lg border-gray-300 p-2"
                    placeholder="Buscar Cliente..."
                    value="<?php echo $busqueda; ?>"
                >
                <input 
                    type="submit" 
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg cursor-pointer hover:bg-blue-600"
                    value="Buscar"
                >
            </div>
        </form>

        <!-- Selector de fecha -->
        <div class="bg-white p-4 rounded-lg shadow mb-4">
            <h2 class="text-2xl font-semibold mb-4">Filtrar por Fecha</h2>
            <div class="mb-4">
                <input 
                    type="date" 
                    class="w-full rounded-lg border-gray-300 p-2"
                    value="<?php echo $fecha; ?>"
                    id="fecha"
                >
            </div>
        </div>
    </div>

    <!-- Listado de Citas -->
    <div class="w-full md:w-2/3 lg:w-3/4">
        <?php if(count($citas) === 0) { ?>
            <p class="text-center text-gray-600">No hay citas para esta fecha o búsqueda</p>
        <?php } ?>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach($citas as $cita) { ?>
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-blue-600 font-semibold mb-2">Cliente: <?php echo $cita->cliente; ?></h3>
                    <p class="mb-2"><span class="font-semibold">Email:</span> <?php echo $cita->email; ?></p>
                    <p class="mb-2"><span class="font-semibold">Teléfono:</span> <?php echo $cita->telefono; ?></p>
                    <p class="mb-2"><span class="font-semibold">Fecha:</span> <?php echo date('d/m/Y', strtotime($cita->fecha)); ?></p>
                    <p class="mb-2"><span class="font-semibold">Hora:</span> <?php echo $cita->hora; ?></p>
                    <p class="mb-2"><span class="font-semibold">Servicios:</span> <?php echo $cita->servicios; ?></p>
                    <p class="mb-4"><span class="font-semibold">Total:</span> $<?php echo number_format($cita->total, 0, ',', '.'); ?></p>
                    
                    <!-- Estado de la cita -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Estado:</label>
                        <select 
                            class="estado-cita w-full p-2 border rounded"
                            data-cita-id="<?php echo $cita->id; ?>"
                        >
                            <option value="pendiente" <?php echo $cita->estado === 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="completada" <?php echo $cita->estado === 'completada' ? 'selected' : ''; ?>>Completada</option>
                            <option value="cancelada" <?php echo $cita->estado === 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
                        </select>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>