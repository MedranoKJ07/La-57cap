<div class="mb-3">
    <label for="titulo" class="form-label">Título</label>
    <input type="text" class="form-control" id="titulo" name="categoria[titulo]" 
           value="<?php echo s($categoria->titulo) ?? ''; ?>" required>
</div>

<div class="mb-3">
    <label for="garantias_meses" class="form-label">Meses de Garantía</label>
    <input type="number" class="form-control" id="garantias_meses" name="categoria[garantias_meses]" 
           value="<?php echo s($categoria->garantias_meses) ?? ''; ?>" required>
</div>

<div class="mb-3">
    <label for="politica_garantia" class="form-label">Política de Garantía</label>
    <textarea class="form-control" id="politica_garantia" name="categoria[politica_garantia]" rows="4" required><?php echo s($categoria->politica_garantia) ?? ''; ?></textarea>
</div>

<div class="mb-3">
    <label for="tiene_garantia" class="form-label">¿Tiene Garantía?</label>
    <select class="form-select" id="tiene_garantia" name="categoria[tiene_garantia]" required>
        <option value="1" <?php echo ($categoria->tiene_garantia == "1") ? 'selected' : ''; ?>>Sí</option>
        <option value="0" <?php echo ($categoria->tiene_garantia == "0") ? 'selected' : ''; ?>>No</option>
    </select>
</div>

<div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select class="form-select" id="estado" name="categoria[estado]">
        <option value="1" <?php echo ($categoria->estado == "1") ? 'selected' : ''; ?>>Activo</option>
        <option value="0" <?php echo ($categoria->estado == "0") ? 'selected' : ''; ?>>Inactivo</option>
    </select>
</div>