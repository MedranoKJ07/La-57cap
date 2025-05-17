<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Compras</h2>
        <a href="/admin/CrearCompra" class="btn btn-light text-primary fw-bold">Nueva Compra</a>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($compras as $compra): ?>
                        <tr>
                            <td><?= s($compra->idCompras) ?></td>
                            <td><?= s($compra->nombre_empresa ?? '—') ?></td>
                            <td><?= s($compra->fecha_compra) ?></td>
                            <td>C$<?= number_format($compra->total_compra, 2) ?></td>
                            <td class="text-center">
                                <a href="/admin/DetalleCompra?id=<?= s($compra->idCompras) ?>" class="btn btn-sm btn-outline-info">Ver Detalle</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>