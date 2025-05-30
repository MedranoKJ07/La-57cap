<div class="card shadow-sm my-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-box-open me-2"></i> Productos en este Pedido</h5>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped text-center align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th><i class="fas fa-tag me-1"></i> Producto</th>
                    <th><i class="fas fa-image me-1"></i> Imagen</th>
                    <th><i class="fas fa-money-bill-wave me-1"></i> Precio</th>
                    <th><i class="fas fa-sort-numeric-up me-1"></i> Cantidad</th>
                    <th><i class="fas fa-coins me-1"></i> Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= s($producto->nombre_producto ?? '') ?></td>
                        <td>
                            <img src="/img/productos/<?= s(trim($producto->Foto ?? '')) ?>"
                                 width="80" class="img-thumbnail rounded shadow-sm" alt="Producto">
                        </td>
                        <td class="text-success fw-semibold">C$ <?= number_format($producto->precio ?? 0, 2) ?></td>
                        <td><?= $producto->cantidad ?? 0 ?></td>
                        <td class="fw-bold">C$ <?= number_format($producto->subtotal ?? 0, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between mt-4">
    <a href="/cliente/pedidos" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-2"></i> Volver a Mis Pedidos
    </a>
    <a href="/tienda" class="btn btn-outline-primary">
        <i class="fas fa-store me-2"></i> Seguir Comprando
    </a>
</div>
