<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: monospace;
            font-size: 11px;
            width: 100%;
            text-align: center;
        }

        .ticket {
            width: 72mm; /* margen interno */
            margin: 0 auto;
            padding: 5px 0;
            text-align: left;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 3px 0;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .total-line {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
        }

        .total-line strong {
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="text-center">
        <h4 style="margin: 0;">Tienda La 57 CAP</h4>
        <p style="margin: 0;">Ticket de venta</p>
        <small><?= date('d/m/Y H:i') ?></small>
    </div>

    <hr>

    <p><strong>Cliente:</strong><br>
        <?= $cliente ? $cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido : $nombreCliente ?>
    </p>

    <hr>

    <table>
        <thead>
        <tr>
            <th style="text-align: left; width: 50%;">Producto</th>
            <th style="text-align: right; width: 15%;">Cant</th>
            <th style="text-align: right; width: 35%;">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($detalles as $item): ?>
            <tr>
                <td><?= $item['nombre_producto'] ?></td>
                <td class="text-right"><?= $item['cantidad'] ?></td>
                <td class="text-right">C$ <?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <div class="total-line"><span><strong>Subtotal:</strong></span><span>C$ <?= number_format($venta->subtotal, 2) ?></span></div>
    <div class="total-line"><span><strong>IVA (15%):</strong></span><span>C$ <?= number_format($venta->iva, 2) ?></span></div>
    <div class="total-line"><strong>Total:</strong><strong>C$ <?= number_format($venta->total, 2) ?></strong></div>

    <hr>

    <p class="text-center">¡Gracias por su compra!</p>
</div>
</body>
</html>
