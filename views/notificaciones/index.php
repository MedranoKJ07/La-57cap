<div class="container py-4">
    <h2 class="mb-4">🔔 Tus Notificaciones</h2>

    <?php if (empty($notificaciones)): ?>
        <div class="alert alert-info">No tienes notificaciones por el momento.</div>
    <?php else: ?>
        <div class="list-group">
            <?php foreach ($notificaciones as $noti): ?>
                <div class="list-group-item d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="mb-1"><?= htmlspecialchars($noti->titulo) ?></h5>
                        <p class="mb-1"><?= htmlspecialchars($noti->descripcion) ?></p>
                        <small class="text-muted"><?= date('d/m/Y H:i', strtotime($noti->creada_fecha)) ?></small>
                    </div>
                    <form method="POST" action="/notificaciones/eliminar" onsubmit="return confirm('¿Deseas eliminar esta notificación?');">
                        <input type="hidden" name="id" value="<?= $noti->idnotificacion ?>">
                        <button class="btn btn-sm btn-outline-danger" title="Eliminar"> Eliminar
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
