<?php
// Inicializar variables con un valor predeterminado si no están definidas
$esLandingPage = $esLandingPage ?? false;
$esError404 = $esError404 ?? false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StyloReserva</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <!-- <link href="/build/css/tailwind.css" rel="stylesheet"> -->
     
    <?php if ($esLandingPage || $esError404): ?>
        <!-- Estilos de Tailwind para la landing page -->
        <link href="/build/css/tailwind.css" rel="stylesheet">
    <?php else: ?>
        <!-- Estilos de SASS para la plataforma interna de StyloReserva -->
        <link href="/build/css/app.css" rel="stylesheet">
    <?php endif; ?>

</head>

    <body>
        <?php echo $contenido; ?>
        <script src="/js/flowbite.min.js"></script>
    </body>
    
</html>