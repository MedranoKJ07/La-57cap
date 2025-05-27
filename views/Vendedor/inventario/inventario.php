<div class="card mt-3">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Inventario Actual</h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Código</th>
                    <th>Producto</th>
                    <th class="text-center">Stock Actual</th>
                    <th class="text-center">Stock Mínimo</th>
                    <th>Última Actualización</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($registros)): ?>
                    <?php foreach ($registros as $registro): ?>
                        <tr class="<?= $registro->cantidad_actual < $registro->cantidad_minima ? 'table-danger' : '' ?>">
                            <td><strong><?= $registro->codigo_producto ?></strong></td>
                            <td><?= $registro->nombre_producto ?></td>
                            <td class="text-center fw-bold <?= $registro->cantidad_actual < $registro->cantidad_minima ? 'text-danger' : 'text-success' ?>">
                                <?= $registro->cantidad_actual ?>
                            </td>
                            <td class="text-center text-muted">
                                <?= $registro->cantidad_minima ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($registro->fecha_actualizacion)) ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="/vendedor/VerProducto?id=<?= $registro->producto_idproducto ?>" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i> Detalles
                                    </a>
                                    <a href="/vendedor/GenerarCodigoBarras?id=<?= $registro->producto_idproducto ?>" class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-barcode"></i> Código
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No hay registros de inventario.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>