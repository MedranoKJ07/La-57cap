<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Devoluciones</h2>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        <!-- Filtro por estado -->
        <form method="GET" class="row g-2 justify-content-end mb-3">
            <div class="col-auto">
                <select name="estado" class="form-select form-select-sm">
                    <option value="">-- Todos los estados --</option>
                    <?php
                    $estados = ['En devolución', 'Visitar tienda', 'Aprobado', 'Rechazado'];
                    $estadoSeleccionado = $_GET['estado'] ?? '';
                    foreach ($estados as $estado):
                    ?>
                        <option value="<?= $estado ?>" <?= $estadoSeleccionado === $estado ? 'selected' : '' ?>>
                            <?= $estado ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">Filtrar</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover mb-0 text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Motivo</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($devoluciones as $devolucion): ?>
                        <?php
                        // Filtrar si se seleccionó un estado
                        if (!empty($estadoSeleccionado) && trim($devolucion->Estado) !== $estadoSeleccionado) {
                            continue;
                        }

                        // Badge color según estado
                        $estado = trim($devolucion->Estado);
                        $badgeClass = match ($estado) {
                            'En devolución' => 'warning',
                            'Visitar tienda' => 'primary',
                            'Aprobado' => 'success',
                            'Rechazado' => 'danger',
                            default => 'secondary'
                        };
                        ?>
                        <tr>
                            <td><?= s($devolucion->idDevoluciones) ?></td>
                            <td><?= s(trim($devolucion->cliente_nombre ?? 'Desconocido')) ?></td>
                            <td><?= s($devolucion->motivo) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($devolucion->fecha_solicitud)) ?></td>
                            <td><span class="badge bg-<?= $badgeClass ?>"><?= $estado ?></span></td>
                            <td>
                                <a href="/admin/devoluciones/detalle?id=<?= s($devolucion->idDevoluciones) ?>"
                                   class="btn btn-outline-info btn-sm">
                                    Ver Detalles
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
