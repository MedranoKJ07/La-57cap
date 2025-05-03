<div class="mb-3">
    <label for="userName" class="card-title mb-0">Nombre de Usuario</label>
    <input type="text" class="form-control" id="userName" name="usuario[userName]"
        value="<?php echo s($usuario->userName); ?>">
</div>
<div class="mb-3">
    <label for="password" class="card-title mb-0">Contraseña</label>
    <input type="password" class="form-control" id="password" name="usuario[password]"
        value="<?php echo s($usuario->password); ?>">
</div>
<div class="mb-3">
    <label for="email" class="card-title mb-0">Email</label>
    <input type="email" class="form-control" id="email" name="usuario[email]" value="<?php echo s($usuario->email); ?>">
</div>
<div class="mb-3">
    <label for="f_perfil" class="card-title mb-0">Image:</label>
    <input type="file" id="f_perfil" accept="image/jpeg, image/png" name="usuario[f_perfil]">
</div>
<div class="mb-3">
    <label for="imagen" class="card-title mb-0">Rol</label>
    <select id="rol" name="usuario[id_roles]" class="form-select mb-3" value="<?php echo s($usuario->id_roles); ?>">
        <option selected disabled value="">-- Seleccione --</option>
        <?php
        foreach ($roles as $rol) { ?>
            <option <?php echo $usuario->id_roles == $rol->idroles ? 'selected' : '' ?>
                value="<?php echo s($rol->idroles) ?>">
                <?php echo s($rol->descripcion) ?>
            </option>
        <?php } ?>
    </select>
</div>