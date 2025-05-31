
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Movimiento de Stock</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2>Reporte de Movimiento de Stock</h2>
    <p>Desde: <?= $inicio ?> &nbsp;&nbsp;&nbsp; Hasta: <?= $fin ?></p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Entradas (Compras)</th>
                <th>Salidas (Ventas)</th>
                <th>Saldo Neto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato): ?>
                <tr>
                    <td><?= $dato['nombre_producto'] ?></td>
                    <td><?= $dato['cantidad_comprada'] ?></td>
                    <td><?= $dato['cantidad_vendida'] ?></td>
                    <td><?= $dato['cantidad_comprada'] - $dato['cantidad_vendida'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
