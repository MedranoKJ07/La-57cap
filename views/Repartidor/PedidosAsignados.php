<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">🛵 Pedidos en Camino</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th># Pedido</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Entrega</th>
                    <th>Total</th>
                    <th>Confirmar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['idpedidos'] ?></td>
                        <td><?= $pedido['p_nombre'] . ' ' . $pedido['s_nombre'] . ' ' . $pedido['p_apellido'] . ' ' . $pedido['s_apellido'] ?>
                        </td>
                        <td><?= $pedido['direccion_entregar'] ?></td>
                        <td><?= $pedido['fecha_entregar'] ?>     <?= $pedido['hora_entregar'] ?></td>
                        <td>C$ <?= number_format($pedido['total'], 2) ?></td>
                        
                        <td>
                            <a href="/repartidor/pedido?id=<?= $pedido['idpedidos'] ?>" class="btn btn-info btn-sm">
                                Ver Detalle
                            </a>
                        </td>



                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
