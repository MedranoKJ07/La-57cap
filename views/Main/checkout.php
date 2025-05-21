<div class="container py-5">
    <h2 class="mb-4 text-center">Finalizar Pedido</h2>

    <?php if (empty($productos)): ?>
        <div class="alert alert-warning text-center">
            Tu carrito está vacío. <a href="/tienda">Agrega productos</a>.
        </div>
    <?php else: ?>
        <form action="/checkout/confirmar" method="POST">
            <div class="row">
                <!-- Formulario de entrega -->
                <div class="col-md-6">
                    <h4 class="mb-3">Información de entrega</h4>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control"
                            value="<?= s($_SESSION['cliente_direccion'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_entrega" class="form-label">Fecha de entrega</label>
                        <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                            min="<?= date('Y-m-d') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="hora_entrega" class="form-label">Hora de entrega</label>
                        <input type="time" name="hora_entrega" id="hora_entrega" class="form-control" min="08:00"
                            max="18:00" required>
                        <small class="text-muted">Horario disponible: 8:00 AM - 6:00 PM</small>
                    </div>

                    <div class="mb-3">
                        <label for="comentarios" class="form-label">Comentarios del pedido</label>
                        <textarea name="comentarios" id="comentarios" class="form-control" rows="3"
                            placeholder="Opcional"></textarea>
                    </div>
                </div>

                <!-- Resumen del carrito -->
                <div class="col-md-6">
                    <h4 class="mb-3">Resumen del pedido</h4>
                    <ul class="list-group">
                        <?php foreach ($productos as $producto): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= s($producto->nombre_producto) ?> (x<?= $producto->cantidad ?>)
                                <span>C$ <?= number_format($producto->subtotal, 2) ?></span>
                            </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center bg-light">
                            <strong>Total</strong>
                            <strong>C$ <?= number_format($total, 2) ?></strong>
                        </li>
                    </ul>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success btn-lg">
                            Finalizar Pedido <i class="fas fa-check ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>