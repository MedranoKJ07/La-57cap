<div class="container py-5">
    <h2 class="mb-4 text-center">Solicitud de Devolución</h2>

    <form action="/cliente/devolucion/guardar" method="POST">
        <input type="hidden" name="pedido_id" value="<?= $pedido->idpedidos ?>">

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Cantidad comprada</th>
                        <th>Cantidad a devolver</th>
                        <th>Motivo</th>
                        <th>Reembolso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= s($producto->nombre_producto) ?></td>
                            <td>
                                <img src="/img/productos/<?= s($producto->Foto) ?>" width="60">
                            </td>
                            <td><?= $producto->cantidad ?></td>
                            <td>
                                <input type="number" name="productos[<?= $producto->idproducto ?>][cantidad]" min="1" max="<?= $producto->cantidad ?>" class="form-control" required>
                            </td>
                            <td>
                                <textarea name="productos[<?= $producto->idproducto ?>][motivo]" class="form-control" rows="2" required></textarea>
                            </td>
                            <td>
                                <select name="productos[<?= $producto->idproducto ?>][tipo_reembolso]" class="form-select" required>
                                    <option value="">Selecciona</option>
                                    <option value="efectivo">Efectivo</option>
                                    <option value="credito">Crédito en tienda</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-danger">Enviar solicitud</button>
            <a href="/cliente/pedidos" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
