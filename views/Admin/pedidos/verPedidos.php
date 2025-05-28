<div class="container py-4">
    <h2 class="text-center mb-4">📦 Todos los Pedidos</h2>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">No hay pedidos registrados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th># Pedido</th>
                        <th>Cliente</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Entrega</th>
                        <th>Repartidor</th>
                        <th>Pago</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td><?= $pedido->idpedidos?></td>
                            <td><?= $pedido->cliente_nombre . ' ' . $pedido->cliente_apellido ?></td>
                            <td><?= $pedido->telefono ?></td>

                            <td><?= $pedido->direccion_entregar?></td>
                            <td><?= $pedido->fecha_entregar . ' ' . $pedido->hora_entregar ?></td>
                            <td><?= $pedido->repartidor_nombre ? $pedido->repartidor_nombre . ' ' . $pedido->repartidor_apellido : 'No asignado' ?>
                            </td>

                            <td>
                                <?php if ($pedido->pago_confirmado): ?>
                                    <span class="badge bg-success">Confirmado</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Pendiente</span>
                                <?php endif; ?>
                            </td>
                            <td>C$ <?= number_format($pedido->total ?? 0, 2) ?></td>

                            <td>
                                <span class="badge bg-info"><?= $pedido->estado_venta ?></span>
                            </td>
                            <td>
                                <a href="/admin/detalle-calificacion?id=<?= $pedido->idpedidos ?>"
                                    class="btn btn-sm btn-outline-primary">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>