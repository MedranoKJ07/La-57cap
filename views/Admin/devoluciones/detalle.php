<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4>Detalle de Devolución #<?= s($devolucion->idDevoluciones) ?></h4>
        </div>
        <div class="card-body">

            <p><strong>Cliente:</strong> <?= s($devolucion->cliente_nombre ?? 'Desconocido') ?></p>
            <p><strong>Motivo general:</strong> <?= s($devolucion->motivo) ?></p>
            <p><strong>Fecha de solicitud:</strong> <?= date('d/m/Y H:i', strtotime($devolucion->fecha_solicitud)) ?></p>
            <p><strong>Estado:</strong> <?= s(trim($devolucion->Estado)) ?></p>

            <?php if (!empty(trim($devolucion->observaciones))): ?>
                <p><strong>Observaciones:</strong> <?= s($devolucion->observaciones) ?></p>
            <?php endif; ?>

            <hr>

            <h5>Productos Solicitados para Devolución</h5>

            <div class="table-responsive">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th>Foto</th>
                            <th>Cantidad</th>
                            <th>Estado del Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalles as $detalle): ?>
                            <tr>
                                <td><?= s($detalle->nombre_producto) ?></td>
                                <td><img src="/img/productos/<?= s($detalle->Foto) ?>" width="60"></td>
                                <td><?= s($detalle->cantidad) ?></td>
                                <td><?= s($detalle->Estado_Producto) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (trim($devolucion->Estado) === 'Pendiente'): ?>
                <div class="mt-4 d-flex gap-3">
                    <form method="POST" action="/admin/devoluciones/aprobar">
                        <input type="hidden" name="id" value="<?= s($devolucion->idDevoluciones) ?>">
                        <button class="btn btn-success">Aprobar</button>
                    </form>

                    <form method="POST" action="/admin/devoluciones/rechazar">
                        <input type="hidden" name="id" value="<?= s($devolucion->idDevoluciones) ?>">
                        <div class="input-group">
                            <input type="text" name="motivo" placeholder="Motivo de rechazo" class="form-control" required>
                            <button class="btn btn-danger">Rechazar</button>
                        </div>
                    </form>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>
