<div class="container py-5">
    <h2 class="mb-4 text-center">Solicitud de Devolución</h2>

    <form action="/cliente/devolucion/guardar" method="POST">
        <input type="hidden" name="pedido_id" value="<?= $pedidoId ?>">

        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Imagen</th>
                        <th>Cantidad comprada</th>
                        <th>Cantidad a devolver</th>
                        <th>Motivo</th>
                        <th>Tipo de reembolso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= s($producto->nombre_producto) ?></td>
                            <td>
                                <?php if (!empty($producto->Foto)): ?>
                                    <img src="/img/productos/<?= s(trim($producto->Foto)) ?>" width="60">
                                <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td><?= (int) $producto->cantidad ?></td>
                            <td>
                                <input 
                                    type="number" 
                                    name="productos[<?= $producto->idproducto ?>][cantidad]" 
                                    min="1"
                                    max="<?= (int) $producto->cantidad ?>" 
                                    class="form-control"
                                    required
                                >
                            </td>
                            <td>
                                <input 
                                    type="text" 
                                    name="productos[<?= $producto->idproducto ?>][motivo]" 
                                    class="form-control" 
                                    placeholder="Motivo de la devolución"
                                    required
                                >
                            </td>
                            <td>
                                <select 
                                    name="productos[<?= $producto->idproducto ?>][tipo]" 
                                    class="form-control" 
                                    required
                                >
                                    <option value="">Seleccione</option>
                                    <option value="dinero">Reembolso en dinero</option>
                                    <option value="cambio">Cambio de producto</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-danger">Enviar solicitud</button>
            <a href="/cliente/pedidos" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>
</div>
