<div class="container py-4">
    <h3 class="mb-4">📝 Calificar Pedido #<?= $pedido->idpedidos ?></h3>

    <form method="POST" action="/cliente/calificar?id=<?= $pedido->idpedidos ?>">
        <div class="mb-3">
            <label for="puntuacion" class="form-label">Puntuación:</label>
            <select name="puntuacion" id="puntuacion" class="form-select" required>
                <option value="">Seleccione una puntuación</option>
                <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
                <option value="4">⭐⭐⭐⭐ Muy bueno</option>
                <option value="3">⭐⭐⭐ Bueno</option>
                <option value="2">⭐⭐ Regular</option>
                <option value="1">⭐ Malo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario (opcional):</label>
            <textarea name="comentario" id="comentario" rows="3" class="form-control"
                placeholder="Comparte tu experiencia..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar Calificación</button>
        <a href="/cliente/pedidos" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
