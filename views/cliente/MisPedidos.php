<div class="container py-5">
    <h2 class="mb-4 text-center">Mis Pedidos</h2>


    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">No tienes pedidos registrados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
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
                        <?php
                        $estado = trim($pedido->estado_venta ?? 'Desconocido');
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


                        $enDevolucion = $pedido->estado_venta === 'En devolución';

                        ?>
                        <tr>
                            <td><?= $pedido->idpedidos ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido->creado)) ?></td>
                            <td>C$ <?= number_format($pedido->total ?? 0, 2) ?></td>
                            <td><span class="badge bg-<?= $badgeClass ?>"><?= $estado ?></span></td>
                            <td><?= date('d/m/Y', strtotime($pedido->fecha_entregar)) ?></td>
                            <td>
                                <a href="/cliente/pedido?id=<?= $pedido->idpedidos ?>"
                                    class="btn btn-outline-primary btn-sm mb-1">
                                    Ver
                                </a>

                                <?php if ($estado === 'Entregado'): ?>
                                    <a href="/cliente/devolucion?id=<?= $pedido->idpedidos ?>" class="btn btn-warning btn-sm mb-1">
                                        Solicitar Devolución
                                    </a>
                                <?php endif; ?>
                                <?php if (empty($calificados[$pedido->idpedidos])): ?>
                                    <a href="/cliente/calificar?id=<?= $pedido->idpedidos ?>" class="btn btn-success btn-sm">
                                        Calificar
                                    </a>
                                <?php endif; ?>




                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>