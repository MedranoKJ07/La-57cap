<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas por Vendedor</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas por Vendedor</h2>
    <p>Desde: <?= $fechaInicio ?> | Hasta: <?= $fechaFin ?></p>

    <table>
        <thead>
            <tr>
                <th>Vendedor</th>
                <th>Total Ventas</th>
                <th>Monto Total (C$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $fila): ?>
                <tr>
                    <td><?= $fila['nombre_vendedor'] ?></td>
                    <td><?= $fila['total_ventas'] ?></td>
                    <td>C$ <?= number_format($fila['monto_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
