<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col mt-0">
                <h2 class="card-title">Gestion Usuarios</h2>
            </div>
            <div class="col-auto mt-0">
                <a href="/admin/CrearUsuario" class="btn btn-success">Crear Nuevo Usuario</a>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="col-12 col-lg-12 col-xl-12">
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rol</th>
                    <th>Foto Perfil</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Confirmado</th>
                    <th>Token</th>
                    <th>Creado</th>
                    <th>Modificado</th>
                    <th>Eliminar</th>
                    <th>Actualizar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario->idusuario; ?></td>
                        <td><?php echo $usuario->id_roles; ?></td>
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
                        <td><?php echo $usuario->token; ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($usuario->Creado_Fecha)); ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($usuario->Cambiado_Fecha)); ?></td>
                        <td>
                            <form action="/propiedades/eliminar" method="post" class="w-100">
                                <input type="hidden" name="id" value=" ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block" value="sel">
                            </form>
                        </td>
                        <td>
                            <a href='/propiedades/actualizar?id=<?php echo $propiedad->id ?>'
                                class="boton-amarillo-block">sel</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
</div>