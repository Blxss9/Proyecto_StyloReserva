<?php
// Ejemplo: Conexión y consulta a la base de datos para obtener los servicios
$conexion = new mysqli('localhost', 'root', '', 'app_styloreserva');
if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

// Consulta para obtener los servicios activos
$query = "SELECT id, nombre, precio FROM servicios WHERE ";
$resultado = $conexion->query($query);
?>

<section class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center">Selecciona el servicios que deseas agendar</h1>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Servicios Disponibles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($servicio = $resultado->fetch_assoc()): ?>
                    <div class="border border-green-500 rounded-lg p-4">
                        <h3 class="text-lg font-bold"><?= htmlspecialchars($servicio['nombre']) ?></h3>
                        <p class="text-lg font-semibold text-gray-800">$<?= number_format($servicio['precio'], 0, ',', '.') ?></p>
                        <p class="text-sm text-gray-500 mt-2">
                            <!-- Puedes agregar descripciones desde otra columna si tienes -->
                            Servicio profesional garantizado.
                        </p>
                        <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600 transition">
                            Agendar servicio
                        </button>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<?php
// Cierra la conexión
$conexion->close();
?>
