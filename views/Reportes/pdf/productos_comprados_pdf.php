<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos Comprados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Reporte de Productos Comprados</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Total Comprado</th>
                <th>Costo Total (C$)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reporte as $fila): ?>
                <tr>
                    <td><?= s($fila['nombre_producto']) ?></td>
                    <td><?= $fila['total_comprado'] ?></td>
                    <td>C$ <?= number_format($fila['costo_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>