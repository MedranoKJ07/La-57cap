<div class="container py-4">
    <h2 class="text-center mb-4"> Calificaciones de Pedidos</h2>

    <?php if (empty($calificaciones)): ?>
        <div class="alert alert-info text-center">No hay calificaciones registradas.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Repartidor</th>
                        <th>Puntuación</th>
                        <th>Comentario</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($calificaciones as $c): ?>
                        <tr>
                            <td><?= $c['idcalificaciones'] ?></td>
                            <td><?= $c['cliente_nombre'] . ' ' . $c['cliente_apellido'] ?></td>
                            <td><?= $c['repartidor_nombre'] . ' ' . $c['repartidor_apellido'] ?></td>
                            <td>⭐ <?= $c['puntuacion'] ?>/5</td>
                            <td><?= $c['comentario'] ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($c['fecha_clasificacion'])) ?></td>
                            <td>
                                <a href="/admin/detalle-calificacion?id=<?= $c['idpedidos'] ?>" class="btn btn-sm btn-outline-primary">
                                    Ver Detalle
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
