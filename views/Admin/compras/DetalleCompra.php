<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Detalle de Compra</h2>
        <a href="/admin/GestionarCompras" class="btn btn-secondary">Volver</a>
    </div>
    <div class="card-body">
        <p><strong>Proveedor:</strong> <?= $compra->nombre_empresa ?? '—' ?></p>
        <p><strong>Fecha:</strong> <?= $compra->fecha_compra ?></p>
        <p><strong>Total:</strong> C$<?= number_format($compra->total_compra, 2) ?></p>

        <hr>
        <h5>Productos Comprados</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $detalle): ?>
                    <tr>
                        <td><?= $detalle->nombre_producto ?></td>
                        <td><?= $detalle->cantidad ?></td>
                        <td>C$<?= number_format($detalle->precio_unitario, 2) ?></td>
                        <td>C$<?= number_format($detalle->subtotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>