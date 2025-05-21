<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?= s($producto->nombre_producto ?? '') ?></td>
                <td>
                    <img src="/img/productos/<?= s(trim($producto->Foto ?? '')) ?>" width="60" alt="Producto">
                </td>
                <td>C$ <?= number_format($producto->precio ?? 0, 2) ?></td>
                <td><?= $producto->cantidad ?? 0 ?></td>
                <td>C$ <?= number_format($producto->subtotal ?? 0, 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="mt-4 d-flex justify-content-between">
    <a href="/cliente/pedidos" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Volver a Mis Pedidos
    </a>
    <a href="/tienda" class="btn btn-outline-primary">
        <i class="fas fa-store me-2"></i> Seguir Comprando
    </a>
</div>