<input type="hidden" name="repartidor[id_usuario]" value="<?php echo s($repartidor->id_usuario); ?>">
<div class="col-md-6">
    <label class="form-label">Primer Nombre</label>
    <input type="text" name="repartidor[p_nombre]" class="form-control" required
        value="<?php echo s($repartidor->p_nombre ?? ''); ?>">
</div>

<div class="col-md-6">
    <label class="form-label">Segundo Nombre</label>
    <input type="text" name="repartidor[s_nombre]" class="form-control"
        value="<?php echo s($repartidor->s_nombre ?? ''); ?>">
</div>

<div class="col-md-6">
    <label class="form-label">Primer Apellido</label>
    <input type="text" name="repartidor[p_apellido]" class="form-control" required
        value="<?php echo s($repartidor->p_apellido ?? ''); ?>">
</div>

<div class="col-md-6">
    <label class="form-label">Segundo Apellido</label>
    <input type="text" name="repartidor[s_apellido]" class="form-control"
        value="<?php echo s($repartidor->s_apellido ?? ''); ?>">
</div>

<div class="col-md-6">
    <label class="form-label">Número de Teléfono</label>
    <input type="text" name="repartidor[n_telefono]" class="form-control" required
        value="<?php echo s($repartidor->n_telefono ?? ''); ?>">
</div>

