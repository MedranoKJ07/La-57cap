<div class="container py-4">
    <h2 class="mb-4 text-center">Detalle del Pedido #<?= $pedido['idpedidos'] ?></h2>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Cliente:</strong> <?= $pedido['cliente_nombre'] . ' ' . $pedido['cliente_apellido'] ?> (<?= $pedido['telefono'] ?? 'Sin número' ?>)</p>
            <p><strong>Dirección de Entrega:</strong> <?= $pedido['direccion_entregar'] ?></p>
            <p><strong>Fecha y Hora de Entrega:</strong> <?= $pedido['fecha_entregar'] ?> <?= $pedido['hora_entregar'] ?></p>
            <p><strong>Repartidor:</strong> <?= $pedido['repartidor_nombre'] ? $pedido['repartidor_nombre'] . ' ' . $pedido['repartidor_apellido'] : 'No asignado' ?></p>
            <p><strong>Estado del Pedido:</strong> <?= $pedido['estado'] ?></p>
            <p><strong>Total:</strong> C$ <?= number_format($pedido['total'], 2) ?></p>
        </div>
    </div>

    <h4>🛒 Productos</h4>
    <table class="table table-bordered">
        <thead class="table-dark text-center">
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $prod): ?>
                <tr class="text-center">
                    <td><?= $prod->nombre_producto ?></td>
                    <td>C$ <?= number_format($prod->precio, 2) ?></td>
                    <td><?= $prod->cantidad ?></td>
                    <td>C$ <?= number_format($prod->subtotal, 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (!empty($pedido['puntuacion'])): ?>
        <div class="mt-4">
            <h4>⭐ Calificación del Cliente</h4>
            <p><strong>Puntuación:</strong> <?= $pedido['puntuacion'] ?>/5</p>
            <p><strong>Comentario:</strong> <?= $pedido['comentario'] ?></p>
            <p><small><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($pedido['fecha_clasificacion'])) ?></small></p>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-4">Este pedido no ha sido calificado.</div>
    <?php endif; ?>
</div>
