<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 503 - Servicio No Disponible</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="text-center">
        <h1 class="display-1 text-danger">503</h1>
        <h2 class="mb-3">Servicio No Disponible</h2>
        <p class="lead"><?= $mensaje ?? 'Estamos teniendo problemas para conectar con la base de datos. Intenta nuevamente más tarde.' ?></p>
        <a href="/" class="btn btn-dark mt-3">Volver al inicio</a>
    </div>
</body>
</html>
