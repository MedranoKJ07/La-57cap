
            <h5 class="mb-3">Datos de Usuario</h5>

            <div class="mb-3">
                <label for="userName" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="usuario[userName]" id="userName" maxlength="45"  value="<?= s($usuario->userName); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="usuario[email]" id="email" maxlength="30" value="<?= s($usuario->email); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="usuario[password]" maxlength="50" id="password" required>
            </div>

            <div class="mb-3">
                <label for="f_perfil" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" name="usuario[f_perfil]" id="f_perfil" accept="image/*">
            </div>

            <hr class="my-4">

            <h5 class="mb-3">Datos del Repartidor</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="p_nombre" class="form-label">Primer Nombre</label>
                    <input type="text" class="form-control" name="repartidor[p_nombre]" id="p_nombre" maxlength="45" value="<?= s($repartidor->p_nombre); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="s_nombre" class="form-label">Segundo Nombre</label>
                    <input type="text" class="form-control" name="repartidor[s_nombre]" id="s_nombre" vmaxlength="45" value="<?= s($repartidor->s_nombre); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="p_apellido" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" name="repartidor[p_apellido]" id="p_apellido" maxlength="45" value="<?= s($repartidor->p_apellido); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="s_apellido" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" name="repartidor[s_apellido]" id="s_apellido" maxlength="45" value="<?= s($repartidor->s_apellido); ?>">
                </div>
                <div class="col-md-6">
                    <label for="n_telefono" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="repartidor[n_telefono]" id="n_telefono" maxlength="15" value="<?= s($repartidor->n_telefono); ?>">
                </div>
            </div>
            
