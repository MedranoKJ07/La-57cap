<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h4 class="mb-0">Detalle del Pedido #<?= $pedido->idpedidos ?></h4>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong>
            <?= $cliente->p_nombre . ' ' . $cliente->s_nombre . ' ' . $cliente->p_apellido . ' ' . $cliente->s_apellido ?>
        </p>
        <p><strong>Teléfono:</strong> <?= $cliente->n_telefono ?></p>
        <p><strong>Dirección:</strong> <?= $pedido->direccion_entregar ?></p>
        <p><strong>Fecha de entrega:</strong> <?= $pedido->fecha_entregar ?> a las <?= $pedido->hora_entregar ?></p>
        <p><strong>Comentarios:</strong> <?= $pedido->comentarios ?: 'Sin comentarios' ?></p>
        <hr>
        <h5>Productos a entregar:</h5>
        <table class="table table-sm table-bordered text-center">
            <thead>
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

        <hr>
        <p><strong>Subtotal:</strong> C$ <?= number_format($venta->subtotal, 2) ?></p>
        <p><strong>IVA (15%):</strong> C$ <?= number_format($venta->iva, 2) ?></p>
        <h5><strong>Total:</strong> C$ <?= number_format($venta->total, 2) ?></h5>
        <form method="POST" action="/repartidor/confirmar-entrega" class="mt-4">
            <input type="hidden" name="id_pedido" value="<?= $pedido->idpedidos ?>">

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="pago_confirmado" id="pagoRecibido"
                    data-btn="btnConfirmar">
                <label class="form-check-label" for="pagoRecibido">
                    ¿Pago recibido?
                </label>
            </div>

            <button type="submit" class="btn btn-success" id="btnConfirmar" style="display: none;">
                Confirmar Entrega
            </button>
        </form>


        <a href="/repartidor/pedidos-en-camino" class="btn btn-secondary mt-3">← Volver</a>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('pagoRecibido');
    const boton = document.getElementById('btnConfirmar');

    checkbox.addEventListener('change', () => {
        boton.style.display = checkbox.checked ? 'inline-block' : 'none';
    });
});
</script>
