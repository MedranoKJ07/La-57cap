<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas por Vendedor</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .logo {
            width: 100px;
            margin-bottom: 10px;
        }

        .titulo-principal {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-size: 14px;
            margin-top: 5px;
        }

        .seccion {
            margin-bottom: 30px;
        }

        .seccion h3 {
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 10px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <img src="data:image/png;base64,<?= $logoBase64 ?>" class="logo" alt="Logo">
    <div class="titulo-principal">REPORTE DE VENTAS POR VENDEDOR</div>
    <div class="subtitulo">Desde: <?= $fechaInicio ?> | Hasta: <?= $fechaFin ?></div>
</header>

<section class="seccion">
    <h3>Detalle por Vendedor</h3>
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
                    <td><?= s($fila['nombre_vendedor']) ?></td>
                    <td><?= $fila['total_ventas'] ?></td>
                    <td>C$ <?= number_format($fila['monto_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<div class="footer">
    Este informe ha sido generado automáticamente por el sistema de ventas de La 57 CAP.  
    <br><br>
    <strong>La 57 CAP © <?= date('Y') ?></strong>
</div>

</body>
</html>
