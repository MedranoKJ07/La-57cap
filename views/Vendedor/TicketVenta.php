<style>
    @media print {
        body {
            margin: 0;
            font-family: monospace;
            width: 80mm;
        }

        .ticket {
            padding: 0 5px;
            font-size: 11px;
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 2px 0;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 4px 0;
        }

        .noprint {
            display: none !important;
        }
    }

    body {
        font-family: monospace;
        background: #fff;
    }

    .ticket {
        width: 300px;
        /* igual a 80mm aprox */
        margin: auto;
        font-size: 11px;
        padding: 10px;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }
</style>

<div class="ticket">
    <div class="text-center">
        <h4>Tienda La 57 CAP</h4>
        <p>Ticket de venta</p>
        <small><?= date('d/m/Y H:i') ?></small>
    </div>

    <hr>

    <p><strong>Cliente:</strong><br>
        <?= $cliente ? $cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido : 'Cliente genérico' ?>
    </p>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th class="text-right">Cant</th>
                <th class="text-right">Total</th>
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

    <p><strong>Subtotal:</strong> C$ <?= number_format($venta->subtotal, 2) ?></p>
    <p><strong>IVA (15%):</strong> C$ <?= number_format($venta->iva, 2) ?></p>
    <h4><strong>Total:</strong> C$ <?= number_format($venta->total, 2) ?></h4>

    <hr>

    <p class="text-center">¡Gracias por su compra!</p>

    <div class="text-center noprint">
        <a class="btn btn-primary" href="/vendedor/ticket-pdf?id=<?= $venta->idventas ?>" target="_blank">
            🖨️ Imprimir PDF
        </a><br>
        <a href="/vendedor/realizar-venta" class="btn btn-secondary mt-2">Nueva Venta</a>
    </div>
    F
</div>