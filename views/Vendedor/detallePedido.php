<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4>📋 Detalle del Pedido #<?= $pedido->idpedidos ?></h4>
    </div>
    <div class="card-body">
        <p><strong>Cliente:</strong> <?= $cliente->p_nombre . ' ' . $cliente->p_apellido ?></p>
        <p><strong>Teléfono:</strong> <?= $cliente->n_telefono ?></p>
        <p><strong>Dirección:</strong> <?= $pedido->direccion_entregar ?></p>
        <p><strong>Fecha de entrega:</strong> <?= $pedido->fecha_entregar ?> a las <?= $pedido->hora_entregar ?></p>

        <h5>🛍 Productos</h5>
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles as $d): ?>
                    <tr>
                        <td><?= $d['nombre_producto'] ?></td>
                        <td><?= $d['cantidad'] ?></td>
                        <td>C$ <?= $d['precio'] ?></td>
                        <td>C$ <?= number_format($d['precio'] * $d['cantidad'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <hr>
        <a href="/ticket-pdf?id=<?= $venta->idventas ?>" target="_blank" class="btn btn-primary">
            🧾 Generar Ticket de Compra
        </a>

        <?php if (!empty($tieneGarantia)): ?>
            <a href="/generar-garantia?id=<?= $venta->idventas ?>" target="_blank" class="btn btn-warning">
                🛡 Generar Certificado de Garantía
            </a>
        <?php endif; ?>
        <a href="/vendedor/atender-pedido?id=<?= $pedido->idpedidos ?>" class="btn btn-primary float-end">✅ Marcar como
            Atendido</a>
    </div>
</div>