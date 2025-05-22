<div class="container py-4">
    <h2 class="mb-4">Detalle de Devolución #<?= s($devolucion->idDevoluciones) ?></h2>

    <p><strong>Cliente:</strong> <?= s($devolucion->cliente_nombre) ?></p>
    <p><strong>Motivo general:</strong> <?= s($devolucion->motivo) ?></p>
    <p><strong>Fecha solicitud:</strong> <?= s($devolucion->fecha_solicitud) ?></p>
    <p><strong>Estado:</strong> <?= s($devolucion->Estado) ?></p>

    <h5 class="mt-4">Productos solicitados</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?= s($detalle->nombre_producto ?? 'N/A') ?></td>
                    <td><?= s($detalle->cantidad) ?></td>
                    <td><?= s($detalle->Estado_Producto) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (trim($devolucion->Estado) === 'Pendiente'): ?>
        <form action="/admin/devoluciones/aprobar" method="POST" class="d-inline">
            <input type="hidden" name="id" value="<?= s($devolucion->idDevoluciones) ?>">
            <button type="submit" class="btn btn-success">Aprobar</button>
        </form>

        <form action="/admin/devoluciones/rechazar" method="POST" class="d-inline ms-2">
            <input type="hidden" name="id" value="<?= s($devolucion->idDevoluciones) ?>">
            <input type="text" name="motivo" placeholder="Motivo del rechazo" required class="form-control d-inline w-auto">
            <button type="submit" class="btn btn-danger ms-2">Rechazar</button>
        </form>
    <?php else: ?>
        <p class="mt-3"><strong>Observaciones:</strong> <?= s($devolucion->observaciones ?: '—') ?></p>
    <?php endif; ?>

    <a href="/admin/devoluciones" class="btn btn-outline-secondary mt-4">Volver a la lista</a>
</div>
