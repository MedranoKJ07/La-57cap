<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 403 - Acceso Denegado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 text-danger">403</h1>
        <h2 class="mb-3">Acceso Denegado</h2>
        <p class="lead"><?= $mensaje ?? 'No tienes permisos para acceder a este recurso.' ?></p>
        <a href="/" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
</body>
</html>
