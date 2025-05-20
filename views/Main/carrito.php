<div class="container py-5">
    <h2 class="mb-4 text-center">Tu Carrito</h2>

    <?php if (empty($productos)): ?>
        <div class="alert alert-info text-center">
            Tu carrito está vacío. <a href="/tienda">Explora productos</a>.
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" id="tabla-carrito">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr data-id="<?= $producto->idproducto ?>">
                            <td><?= s($producto->nombre_producto) ?></td>
                            <td>
                                <img src="/img/productos/<?= s($producto->Foto) ?>" width="60" alt="<?= s($producto->nombre_producto) ?>">
                            </td>
                            <td class="precio"><?= number_format($producto->precio, 2, '.', '') ?></td>
                            <td>
                                <input type="number" class="form-control cantidad-input mx-auto" min="1"
                                       value="<?= $producto->cantidad ?>" style="width: 80px;">
                            </td>
                            <td class="subtotal">C$ <?= number_format($producto->subtotal, 2) ?></td>
                            <td>
                                <a href="/carrito/eliminar?id=<?= $producto->idproducto ?>" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2" id="total-general"><strong>C$ <?= number_format($total, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="/checkout" class="btn btn-primary btn-lg">
                Confirmar Pedido <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const tabla = document.getElementById('tabla-carrito');
    const totalGeneral = document.getElementById('total-general');

    tabla.querySelectorAll(".cantidad-input").forEach(input => {
        input.addEventListener("change", function () {
            const fila = this.closest("tr");
            const id = fila.dataset.id;
            const precio = parseFloat(fila.querySelector(".precio").textContent);
            const nuevaCantidad = parseInt(this.value);

            if (nuevaCantidad < 1) {
                this.value = 1;
                return;
            }

            // Calcular subtotal en frontend
            const nuevoSubtotal = (precio * nuevaCantidad).toFixed(2);
            fila.querySelector(".subtotal").textContent = "C$ " + nuevoSubtotal;

            // Enviar al backend (AJAX)
            fetch("/carrito/actualizar", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: id, cantidad: nuevaCantidad })
            }).then(() => recalcularTotal());
        });
    });

    function recalcularTotal() {
        let total = 0;
        tabla.querySelectorAll("tbody tr").forEach(fila => {
            const subtotal = parseFloat(fila.querySelector(".subtotal").textContent.replace("C$ ", ""));
            total += subtotal;
        });
        totalGeneral.innerHTML = `<strong>C$ ${total.toFixed(2)}</strong>`;
    }
});
</script>
