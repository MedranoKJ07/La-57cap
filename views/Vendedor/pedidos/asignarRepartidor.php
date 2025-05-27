<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">🛵 Asignar Repartidor</h4>
    </div>
    <?php if (!empty($_SESSION['mensaje'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <?php unset($_SESSION['mensaje']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th># Pedido</th>
                    <th>Cliente</th>
                    <th>Entrega</th>
                    <th>Dirección</th>
                    <th>Total</th>
                    <th>Asignar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['idpedidos'] ?></td>
                        <td><?= $pedido['p_nombre'] . ' ' . $pedido['s_nombre'] . ' ' . $pedido['p_apellido'] . ' ' . $pedido['s_apellido'] ?>
                        </td>
                        <td><?= $pedido['fecha_entregar'] ?>     <?= $pedido['hora_entregar'] ?></td>
                        <td><?= $pedido['direccion_entregar'] ?></td>
                        <td>C$ <?= number_format($pedido['total'], 2) ?></td>
                        <td>
                            <form method="POST" action="/vendedor/asignar-repartidor">
                                <input type="hidden" name="id_pedido" value="<?= $pedido['idpedidos'] ?>">
                                <select name="id_repartidor" class="form-select form-select-sm" required>
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($repartidores as $r): ?>
                                        <option value="<?= $r->idrepartidor ?>">
                                            <?= $r->p_nombre . ' ' . $r->p_apellido ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Asignar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>