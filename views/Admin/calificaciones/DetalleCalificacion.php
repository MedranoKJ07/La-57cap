<div class="container py-4">
    <h2 class="text-center mb-4">📦 Detalle del Pedido #<?= $pedido['idpedidos'] ?> Calificado</h2>

    <p><strong>Cliente:</strong> <?= $pedido['cliente_nombre'] . ' ' . $pedido['cliente_sn'] . ' ' . $pedido['cliente_apellido'] . ' ' . $pedido['cliente_sa'] ?></p>
    <p><strong>Teléfono:</strong> <?= $pedido['n_telefono'] ?></p>
    <p><strong>Dirección:</strong> <?= $pedido['direccion_entregar'] ?></p>
    <p><strong>Fecha Entrega:</strong> <?= $pedido['fecha_entregar'] ?> a las <?= $pedido['hora_entregar'] ?></p>
    <p><strong>Comentarios del Pedido:</strong> <?= $pedido['comentarios'] ?: 'Sin comentarios' ?></p>

    <?php if ($pedido['id_repartidor']): ?>
        <p><strong>Repartidor:</strong> <?= $pedido['repartidor_nombre'] . ' ' . $pedido['repartidor_sn'] . ' ' . $pedido['repartidor_apellido'] . ' ' . $pedido['repartidor_sa'] ?></p>
    <?php endif; ?>

    <hr>

    <h5>Productos entregados:</h5>
    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detalles as $d): ?>
                <tr>
                    <td><?= $d->nombre_producto ?></td>
                    <td><?= $d->codigo_producto ?></td>
                    <td><?= $d->cantidad ?></td>
                    <td>C$ <?= number_format($d->precio, 2) ?></td>
                    <td>C$ <?= number_format($d->subtotal, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p><strong>Subtotal:</strong> C$ <?= number_format($pedido['subtotal'], 2) ?></p>
    <p><strong>IVA:</strong> C$ <?= number_format($pedido['iva'], 2) ?></p>
    <h5><strong>Total:</strong> C$ <?= number_format($pedido['total'], 2) ?></h5>

    <hr>

    <h5>📝 Calificación:</h5>
    <p><strong>Puntuación:</strong> ⭐ <?= $pedido['puntuacion'] ?>/5</p>
    <p><strong>Comentario:</strong> <?= $pedido['comentario'] ?></p>
    <p><small><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($pedido['fecha_clasificacion'])) ?></small></p>

    
</div>
