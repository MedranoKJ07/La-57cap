<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos por Repartidor</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Reporte de Pedidos por Repartidor</h2>
    <p>Desde: <?= $inicio ?> | Hasta: <?= $fin ?></p>
    <table>
        <thead>
            <tr>
                <th>Repartidor</th>
                <th>Total Pedidos Entregados</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $r): ?>
                <tr>
                    <td><?= $r['p_nombre'] . ' ' . $r['p_apellido'] ?></td>
                    <td><?= $r['total_pedidos'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
