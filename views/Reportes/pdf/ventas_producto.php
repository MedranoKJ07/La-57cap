<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas por Producto</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas por Producto</h2>
    <p>Desde: <?= $fechaInicio ?> | Hasta: <?= $fechaFin ?></p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Total Vendidos</th>
                <th>Monto Total (C$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $r): ?>
                <tr>
                    <td><?= $r['nombre_producto'] ?></td>
                    <td><?= $r['total_vendidos'] ?></td>
                    <td>C$ <?= number_format($r['monto_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
