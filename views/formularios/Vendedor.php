
            <h5 class="text-primary">Datos de Usuario</h5>
            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input class="form-control" name="usuario[userName]" maxlength="45" type="text" required value="<?= s($usuario->userName); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" name="usuario[email]" maxlength="30" type="email" required value="<?= s($usuario->email); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" name="usuario[password]" maxlength="45" type="password" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto de Perfil</label>
                <input class="form-control" name="usuario[f_perfil]" type="file" accept="image/*">
            </div>

            <hr>
            <h5 class="text-primary">Datos del Vendedor</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primer Nombre</label>
                    <input class="form-control" name="vendedor[p_nombre]" maxlength="45" type="text" required value="<?= s($vendedor->p_nombre); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Segundo Nombre</label>
                    <input class="form-control" name="vendedor[s_nombre]" maxlength="45" type="text" value="<?= s($vendedor->s_nombre); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Primer Apellido</label>
                    <input class="form-control" name="vendedor[p_apellido]" maxlength="45" type="text" required value="<?= s($vendedor->p_apellido); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Segundo Apellido</label>
                    <input class="form-control" name="vendedor[s_apellido]" maxlength="45" type="text" value="<?= s($vendedor->s_apellido); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Teléfono</label>
                    <input class="form-control" name="vendedor[n_telefono]"  maxlength="45" type="tel" required value="<?= s($vendedor->n_telefono); ?>">
                </div>

