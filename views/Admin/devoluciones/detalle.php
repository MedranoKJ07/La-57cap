<div class="container py-4">
    <h2 class="mb-4">Detalle de Devolución #<?= $devolucion->idDevoluciones ?></h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Cliente:</strong> <?= s($devolucion->cliente_nombre ?? 'Desconocido') ?></p>

            <p><strong>Fecha de Solicitud:</strong> <?= s($devolucion->fecha_solicitud) ?></p>
            <p><strong>Motivo:</strong> <?= s($devolucion->motivo) ?></p>
            <p><strong>Tipo de Reembolso:</strong> <?= s($devolucion->tipo_reembolso) ?></p>
            <p><strong>Estado:</strong>
                <?php
                $estado = $devolucion->Estado;
                $badgeClass = match ($estado) {
                    'Pendiente' => 'warning',
                    'En devolución' => 'info',
                    'Devolución aprobada' => 'success',
                    'Devolución rechazada' => 'danger',
                    'Visitar tienda' => 'primary',
                    'En proceso' => 'info',
                    'En camino' => 'info',
                    'Entregado' => 'success',
                    default => 'secondary'
                };

                ?>
                <span class="badge bg-<?= $badgeClass ?>"><?= $estado ?></span>
            </p>

            <?php if (!empty($devolucion->observaciones)): ?>
                <p><strong>Observaciones:</strong> <?= s($devolucion->observaciones) ?></p>
            <?php endif; ?>
        </div>
    </div>

    <h5>Productos Solicitados:</h5>
    <table class="table table-sm table-bordered text-center">
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
                    <td><?= s($detalle->nombre_producto) ?></td>
                    <td><?= $detalle->cantidad ?></td>
                    <td><?= s($detalle->Estado_Producto) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Acciones según estado -->

    <?php if (trim($estado) == 'En devolucion'): ?>
        <form method="POST" action="/admin/devoluciones/visitar-tienda">
            <input type="hidden" name="id" value="<?= $devolucion->idDevoluciones ?>">
            <button class="btn btn-primary">Marcar como “Visitar tienda”</button>
        </form>
    <?php elseif ($estado === 'Visitar tienda'): ?>
        <div class="d-flex gap-2 mt-3">
            <form method="POST" action="/admin/devoluciones/aprobar">
                <input type="hidden" name="id" value="<?= $devolucion->idDevoluciones ?>">
                <button class="btn btn-success">Aprobar Devolución</button>
            </form>
            <form method="POST" action="/admin/devoluciones/rechazar">
                <input type="hidden" name="id" value="<?= $devolucion->idDevoluciones ?>">
                <div class="d-flex align-items-center gap-2">
                    <input type="text" name="motivo" class="form-control" placeholder="Motivo del rechazo" required>
                    <button class="btn btn-danger">Rechazar Devolución</button>
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="alert alert-info mt-3">Esta devolución ya fue procesada.</div>
    <?php endif; ?>
</div>