
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Reporte de Ventas por Fecha</h2>
    <p><strong>Periodo:</strong> <?= $fechaInicio ?> al <?= $fechaFin ?></p>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total Ventas</th>
                <th>Monto Total (C$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $fila): ?>
            <tr>
                <td><?= $fila['fecha'] ?></td>
                <td><?= $fila['total_ventas'] ?></td>
                <td><?= number_format($fila['monto_total'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
