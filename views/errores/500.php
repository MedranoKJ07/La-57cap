<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 500 - Error Interno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 text-warning">500</h1>
        <h2 class="mb-3">Error Interno del Servidor</h2>
        <p class="lead"><?= $mensaje ?? 'Ups... algo salió mal. Intenta más tarde.' ?></p>
        <a href="/" class="btn btn-secondary mt-3">Volver al inicio</a>
    </div>
</body>
</html>
