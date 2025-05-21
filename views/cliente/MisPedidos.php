<div class="container py-5">
    <h2 class="mb-4">Mis Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info">No tienes pedidos registrados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Entrega</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido->idpedidos ?></td>
                            <td><?= date('d-m-Y H:i', strtotime($pedido->creado)) ?></td>
                            <td>C$ <p>C$ <?= number_format($pedido->total ?? 0, 2) ?></p>
                            </td>
                            <td>
                                <p>C$ <?= number_format($pedido->total ?? 0, 2) ?></p>
                                <?= s($pedido->estado_venta ?? 'Desconocido') ?>
                            </td>
                            <td><?= date('d/m/Y', strtotime($pedido->fecha_entregar)) ?></td>
                            <td>
                                <a href="/cliente/pedido?id=<?= $pedido->idpedidos ?>" class="btn btn-outline-primary px-2 py-0"
                                    style="font-size: 0.75rem;">
                                    Ver
                                </a>

                                <a href="/cliente/devolucion?id=<?= $pedido->idpedidos ?>"
                                    class="btn btn-outline-danger px-2 py-0 ms-1" style="font-size: 0.75rem;">
                                    Devolver
                                </a>


                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>