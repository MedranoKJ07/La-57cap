<div class="container py-4">
    <h2 class="mb-4">Detalle de la Devolución #<?= $devolucion->idDevoluciones ?></h2>

    <div class="mb-3">
        <strong>Motivo general:</strong> <?= htmlspecialchars($devolucion->motivo) ?><br>
        <strong>Tipo de reembolso:</strong> <?= htmlspecialchars($devolucion->tipo_reembolso) ?><br>
        <strong>Estado:</strong> <?= htmlspecialchars($devolucion->Estado) ?><br>
        <strong>Fecha de solicitud:</strong> <?= $devolucion->fecha_solicitud ?>
    </div>

    <h5>Productos solicitados para devolución</h5>
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Motivo del producto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?= htmlspecialchars($detalle->nombre_producto) ?></td>
                    <td><?= $detalle->cantidad ?></td>
                    <td><?= htmlspecialchars($detalle->Estado_Producto) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (trim($devolucion->Estado) === 'Pendiente'): ?>
        <form method="POST" action="/admin/devoluciones/aprobar" class="d-inline">
            <input type="hidden" name="id" value="<?= $devolucion->idDevoluciones ?>">
            <button class="btn btn-success">Aprobar</button>
        </form>

        <form method="POST" action="/admin/devoluciones/rechazar" class="d-inline ms-2">
            <input type="hidden" name="id" value="<?= $devolucion->idDevoluciones ?>">
            <input type="text" name="motivo" class="form-control d-inline-block" style="width: 250px;" placeholder="Motivo de rechazo" required>
            <button class="btn btn-danger ms-1">Rechazar</button>
        </form>
    <?php else: ?>
        <div class="alert alert-info mt-3">
            Esta solicitud ya fue <strong><?= htmlspecialchars($devolucion->Estado) ?></strong>.
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <a href="/admin/devoluciones" class="btn btn-secondary">Volver</a>
    </div>
</div>
