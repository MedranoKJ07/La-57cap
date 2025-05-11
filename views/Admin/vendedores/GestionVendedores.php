<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col mt-0">
                <h2 class="card-title">Gestión de Vendedores</h2>
            </div>
            <div class="col-auto mt-0">
                <a href="/admin/CrearUsuarioVendedor" class="btn btn-success">Crear Nuevo Vendedor</a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <form method="POST" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar por nombre o correo"
                   value="<?php echo $busqueda ?? ''; ?>">
            <input type="submit" class="btn btn-primary" value="Filtrar">
            <a href="/admin/GestionarVendedores" class="btn btn-secondary">Limpiar</a>
        </form>
    </div>

    <div class="col-12">
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>Teléfono</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Confirmado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vendedores as $vendedor): ?>
                    <tr>
                        <td><?php echo "$vendedor->p_nombre $vendedor->s_nombre $vendedor->p_apellido $vendedor->s_apellido"; ?></td>
                        <td><?php echo $vendedor->n_telefono; ?></td>
                        <td><?php echo $vendedor->userName ?? '—'; ?></td>
                        <td><?php echo $vendedor->email ?? '—'; ?></td>
                        <td>
                            <?php 
                                $estado = ($vendedor->confirmado ?? "0") == "1" ? "Sí" : "No";
                                $color = ($vendedor->confirmado ?? "0") == "1" ? "success" : "secondary";
                            ?>
                            <span class="badge bg-<?php echo $color; ?>"><?php echo $estado; ?></span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="/admin/EliminarVendedor" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $vendedor->idvendedor; ?>">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                </form>
                                <a href="/admin/ActualizarUsuario?id=<?php echo $vendedor->id_usuario;?>&t=vendedor&ids=<?php echo $vendedor->idvendedor?>" class="btn btn-sm btn-warning">Actualizar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
