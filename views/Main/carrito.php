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
                                <img src="/img/productos/<?= s($producto->Foto) ?>" width="60"
                                    alt="<?= s($producto->nombre_producto) ?>">
                            </td>
                            <td class="precio"><?= number_format($producto->precio, 2, '.', '') ?></td>
                            <td>
                                <input type="number" class="form-control cantidad-input mx-auto" min="1"
                                    max="<?= $producto->stock_disponible ?>" value="<?= $producto->cantidad ?>"
                                    style="width: 80px;">
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
                        <td colspan="4" class="text-end"><strong>Subtotal (sin IVA):</strong></td>
                        <td colspan="2" id="subtotal-general">C$ 0.00</td>
                    </tr>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end"><strong>IVA (15%):</strong></td>
                        <td colspan="2" id="iva-general">C$ 0.00</td>
                    </tr>
                    <tr class="table-secondary">
                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2" id="total-general"><strong>C$ 0.00</strong></td>
                    </tr>
                </tfoot>


            </table>

        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="/tienda" class="btn btn-outline-secondary">
                ← Agregar más productos
            </a>

            <a href="/checkout" class="btn btn-primary">
                Confirmar Pedido <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>


    <?php endif; ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tabla = document.getElementById('tabla-carrito');

        const subtotalEl = document.getElementById("subtotal-general");
        const ivaEl = document.getElementById("iva-general");
        const totalEl = document.getElementById("total-general");

        tabla.querySelectorAll(".cantidad-input").forEach(input => {
            input.addEventListener("change", function () {
                const fila = this.closest("tr");
                const id = fila.dataset.id;
                const precio = parseFloat(fila.querySelector(".precio").textContent);
                const nuevaCantidad = parseInt(this.value);
                const max = parseInt(this.getAttribute("max"));

                if (nuevaCantidad < 1) {
                    this.value = 1;
                    return;
                }

                if (nuevaCantidad > max) {
                    alert(`Solo hay ${max} unidades disponibles para este producto.`);
                    this.value = max;
                    return;
                }

                const nuevoSubtotal = (precio * this.value).toFixed(2);
                fila.querySelector(".subtotal").textContent = "C$ " + nuevoSubtotal;

                fetch("/carrito/actualizar", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id: id, cantidad: this.value })
                }).then(() => recalcularTotales());
            });
        });

        recalcularTotales(); // Cargar valores desde inicio

        function recalcularTotales() {
            let subtotal = 0;

            tabla.querySelectorAll("tbody tr").forEach(fila => {
                const precio = parseFloat(fila.querySelector(".precio").textContent);
                const cantidad = parseInt(fila.querySelector(".cantidad-input").value);
                subtotal += precio * cantidad;
            });

            const iva = subtotal * 0.15;
            const total = subtotal + iva;

            subtotalEl.textContent = `C$ ${subtotal.toFixed(2)}`;
            ivaEl.textContent = `C$ ${iva.toFixed(2)}`;
            totalEl.innerHTML = `<strong>C$ ${total.toFixed(2)}</strong>`;
        }

    });
</script>