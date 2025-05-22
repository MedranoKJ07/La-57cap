<div class="container py-5">
    <h2 class="mb-4 text-center">Mis Pedidos</h2>

    <!-- Filtro por estado -->
    <form method="GET" class="row g-2 justify-content-end mb-3">
        <div class="col-auto">
            <select name="estado" class="form-select form-select-sm">
                <option value="">-- Todos los estados --</option>
                <?php
                $estados = ['Pendiente', 'En devolución', 'Aprobado', 'Rechazado', 'Entregar en tienda'];
                $estadoSeleccionado = $_GET['estado'] ?? '';
                foreach ($estados as $e):
                ?>
                    <option value="<?= $e ?>" <?= $estadoSeleccionado === $e ? 'selected' : '' ?>>
                        <?= $e ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
        </div>
    </form>

    <?php if (empty($pedidos)): ?>
        <div class="alert alert-info text-center">No tienes pedidos registrados.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Entrega</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                        <?php
                        $estado = trim($pedido->estado_venta ?? 'Desconocido');
                        $badgeClass = match ($estado) {
                            'Pendiente' => 'warning',
                            'En devolución' => 'info',
                            'Aprobado' => 'success',
                            'Rechazado' => 'danger',
                            'Entregar en tienda' => 'primary',
                            default => 'secondary'
                        };

                        $enDevolucion = $pedido->estado_venta === 'En devolución';
                        ?>
                        <tr>
                            <td><?= $pedido->idpedidos ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($pedido->creado)) ?></td>
                            <td>C$ <?= number_format($pedido->total ?? 0, 2) ?></td>
                            <td><span class="badge bg-<?= $badgeClass ?>"><?= $estado ?></span></td>
                            <td><?= date('d/m/Y', strtotime($pedido->fecha_entregar)) ?></td>
                            <td>
                                <a href="/cliente/pedido?id=<?= $pedido->idpedidos ?>" class="btn btn-outline-primary btn-sm mb-1">
                                    Ver
                                </a>
                                <?php if (!$enDevolucion): ?>
                                    <a href="/cliente/devolucion?id=<?= $pedido->idpedidos ?>" class="btn btn-warning btn-sm">
                                        Solicitar Devolución
                                    </a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">En proceso</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
