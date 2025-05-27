<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0">📦 Pedidos Pendientes</h4>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th># Pedido</th>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Entrega</th>
                    <th>Total</th>
                    <th>Estado Venta</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['idpedidos'] ?></td>
                        <td><?= $pedido['p_nombre'] . ' ' . $pedido['s_nombre'] . ' ' . $pedido['p_apellido'] . ' ' . $pedido['s_apellido'] ?></td>
                        <td><?= $pedido['n_telefono'] ?></td>
                        <td><?= $pedido['direccion_entregar'] ?></td>
                        <td><?= $pedido['fecha_entregar'] ?> <?= $pedido['hora_entregar'] ?></td>
                        <td>C$ <?= number_format($pedido['total'], 2) ?></td>
                        <td><?= $pedido['estado_venta'] ?></td>
                        <td>
                            <a href="/vendedor/atender-pedido?id=<?= $pedido['idpedidos'] ?>" class="btn btn-success btn-sm">
                                Atender
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
