<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col mt-0">
                <h2 class="card-title">Gestion Usuarios</h2>
            </div>
            <div class="col-auto mt-0">
                <a href="/admin/CrearUsuario?t=1" class="btn btn-light text-primary fw-bold">Crear Nuevo Usuario Administrador</a>
            </div>
        </div>

    </div>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">

            <div class="col-auto mt-0">
                <form method="POST" action="" class="mb-3 d-flex gap-2 flex-wrap align-items-center">
                    <select name="rol" class="form-select w-auto">
                        <option value="">-- Seleccione un rol --</option>
                        <?php foreach ($rolesDisponibles as $id => $nombre): ?>
                            <option value="<?php echo $id; ?>" <?php echo ((string) $rolSeleccionado === (string) $id) ? 'selected' : ''; ?>>
                                <?php echo $nombre; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar usuario o email"
                        value="<?php echo $busqueda; ?>">

                    <input type="submit" class="btn btn-primary" value="Filtrar">
                    <a href="/admin/GestionarUsuario" class="btn btn-secondary">Limpiar</a>
                </form>

            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-12">
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    
                    <th>Rol</th>
                    <th>Foto Perfil</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Confirmado</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        
                        <td>
                            <?php
                            $roles = [
                                '1' => 'Administrador',
                                '2' => 'Vendedor',
                                '3' => 'Repartidor',
                                '4' => 'Cliente'
                            ];
                            echo $roles[$usuario->id_roles] ?? 'Desconocido';
                            ?>
                        </td>
                        <td>

                            <img src="/img/users/<?php echo $usuario->f_perfil; ?>" alt="Perfil" width="40" height="40"
                                style="border-radius: 50%;">
                        </td>
                        <td><?php echo $usuario->userName; ?></td>
                        <td><?php echo $usuario->email; ?></td>
                        <td>
                            <?php
                            $estado = $usuario->confirmado == "1" ? "Sí" : "No";
                            $color = $usuario->confirmado == "1" ? "success" : "secondary";
                            ?>
                            <span class="badge bg-<?php echo $color; ?>"><?php echo $estado; ?></span>
                        </td>
                        
                        <td><?php echo date('d/m/Y H:i:s', strtotime($usuario->Creado_Fecha)); ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($usuario->Cambiado_Fecha)); ?></td>
                        <td>
                            <form action="/admin/EliminarUsuario" method="post" class="w-100">
                                <input type="hidden" name="id" value="<?php echo $usuario->idusuario; ?>">
                                <input type="hidden" name="tipo" value="usuario">
                                <input type="submit" class="btn btn-danger" value="Eliminar">
                            </form>
                        </td>
                        <td>
                            <a href='/admin/ActualizarUsuario?id=<?php echo $usuario->idusuario; ?>'
                                class="btn btn-warning">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>