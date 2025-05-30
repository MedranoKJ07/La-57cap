<div class="container py-4">
    <h2 class="mb-4">🔔 Tus Notificaciones</h2>

    <?php if (empty($notificaciones)): ?>
        <div class="alert alert-info">No tienes notificaciones por el momento.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($notificaciones as $noti): ?>
                <div class="list-group-item">
                    <h5 class="mb-1"><?= htmlspecialchars($noti->titulo) ?></h5>
                    <p class="mb-1"><?= htmlspecialchars($noti->descripcion) ?></p>
                    <small class="text-muted"><?= date('d/m/Y H:i', strtotime($noti->creada_fecha)) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
