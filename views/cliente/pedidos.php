<div class="container py-5">
    <h2 class="mb-4 text-center">Mis Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">
            No tienes pedidos registrados.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th># Pedido</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Entrega</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido->idpedidos ?></td>
                            <td><?= date('d/m/Y', strtotime($pedido->creado)) ?></td>
                            <td>C$ <?= number_format($pedido->total, 2) ?></td>
                            <td><?= s($pedido->estado_venta) ?></td>
                            <td><?= date('d/m/Y', strtotime($pedido->fecha_entregar)) ?></td>
                            <td>
                                <a href="/cliente/pedido?id=<?= $pedido->idpedidos ?>" class="btn btn-info btn-sm">
                                    Ver Detalles
                                </a>
                                <a href="/cliente/devolucion?id=<?= $pedido->idpedidos ?>" class="btn btn-warning btn-sm">
                                    Solicitar Devolución
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
