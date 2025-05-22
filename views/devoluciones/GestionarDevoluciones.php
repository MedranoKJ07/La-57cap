<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Devoluciones</h2>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($devoluciones as $devolucion): ?>
                        <tr>
                            <td><?= s($devolucion->idDevoluciones) ?></td>
                            <td><?= s($devolucion->cliente_nombre ?? 'Desconocido') ?></td>
                            <td><?= s($devolucion->motivo) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($devolucion->fecha_solicitud)) ?></td>
                            <td><?= s($devolucion->Estado) ?></td>
                            <td class="text-center">
                                <a href="/admin/devoluciones/detalle?id=<?= $devolucion->idDevoluciones ?>"
                                    class="btn btn-sm btn-outline-info">Ver Detalle</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>