<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 404 - Página no encontrada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 text-danger">404</h1>
        <h2 class="mb-3">Página no encontrada</h2>
        <p class="lead"><?= $mensaje ?? 'La URL que buscás no existe o fue movida. Verifica el enlace.' ?></p>
        <a href="/" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
</body>
</html>
