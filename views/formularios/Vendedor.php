<!-- id_usuario oculto -->
<input type="hidden" name="vendedor[id_usuario]" value="<?php echo s($vendedor->id_usuario); ?>">


<div class="col-md-6">
    <label class="card-title">Primer Nombre</label>
    <input type="text" name="vendedor[p_nombre]" class="form-control" required
        value="<?php echo s($vendedor->p_nombre) ?? ''; ?>">
</div>

<div class="col-md-6">
    <label class="card-title">Segundo Nombre</label>
    <input type="text" name="vendedor[s_nombre]" class="form-control"
        value="<?php echo s($vendedor->s_nombre) ?? ''; ?>">
</div>

<div class="col-md-6">
    <label class="card-title">Primer Apellido</label>
    <input type="text" name="vendedor[p_apellido]" class="form-control" required
        value="<?php echo s($vendedor->p_apellido) ?? ''; ?>">
</div>

<div class="col-md-6">
    <label class="card-title">Segundo Apellido</label>
    <input type="text" name="vendedor[s_apellido]" class="form-control"
        value="<?php echo s($vendedor->s_apellido) ?? ''; ?>">
</div>

<div class="col-md-6">
    <label class="card-title">Número de Teléfono</label>
    <input type="text" name="vendedor[n_telefono]" class="form-control" required
        value="<?php echo s($vendedor->n_telefono) ?? ''; ?>">
</div>