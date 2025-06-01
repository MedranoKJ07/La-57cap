<div class="row g-3">
    <div class="col-md-6">
        <label for="nombre_empresa" class="form-label">Nombre de la Empresa</label>
        <input type="text" class="form-control" name="proveedor[nombre_empresa]" required maxlength="100"
            value="<?php echo s($proveedor->nombre_empresa); ?>">
    </div>

    <div class="col-md-6">
        <label for="contacto" class="form-label">Contacto</label>
        <input type="text" class="form-control" name="proveedor[contacto]" required maxlength="100"
            value="<?php echo s($proveedor->contacto); ?>">
    </div>

    <div class="col-md-6">
        <label for="telefono" class="form-label">Teléfono</label>
        <input type="text" class="form-control" name="proveedor[telefono]" required maxlength="20"
            value="<?php echo s($proveedor->telefono); ?>">
    </div>

    <div class="col-md-6">
        <label for="direccion" class="form-label">Dirección</label>
        <input type="text" class="form-control" name="proveedor[direccion]" required maxlength="200"
            value="<?php echo s($proveedor->direccion); ?>">
    </div>

    <div class="col-md-6">
        <label for="nacionalidad" class="form-label">Nacionalidad</label>
        <select name="proveedor[nacionalidad]" class="form-select" required>
            <option value="">-- Selecciona una opción --</option>
            <option value="nacional" <?php echo $proveedor->nacionalidad === 'nacional' ? 'selected' : ''; ?>>Nacional</option>
            <option value="extranjera" <?php echo $proveedor->nacionalidad === 'extranjera' ? 'selected' : ''; ?>>Extranjera</option>
        </select>
    </div>
</div>