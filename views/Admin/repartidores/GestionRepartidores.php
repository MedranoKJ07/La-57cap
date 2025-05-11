<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col mt-0">
                <h2 class="card-title">Gestión de Repartidores</h2>
            </div>
            <div class="col-auto mt-0">
                <a href="/admin/CrearRepartidor" class="btn btn-success">Crear Nuevo Repartidor</a>
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
            <a href="/admin/GestionarRepartidores" class="btn btn-secondary">Limpiar</a>
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
                <?php foreach ($repartidores as $repartidor): ?>
                    <tr>
                        <td><?php echo "$repartidor->p_nombre $repartidor->s_nombre $repartidor->p_apellido $repartidor->s_apellido"; ?></td>
                        <td><?php echo $repartidor->n_telefono; ?></td>
                        <td><?php echo $repartidor->userName ?? '—'; ?></td>
                        <td><?php echo $repartidor->email ?? '—'; ?></td>
                        <td>
                            <?php 
                                $estado = ($repartidor->confirmado ?? "0") == "1" ? "Sí" : "No";
                                $color = ($repartidor->confirmado ?? "0") == "1" ? "success" : "secondary";
                            ?>
                            <span class="badge bg-<?php echo $color; ?>"><?php echo $estado; ?></span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="/admin/EliminarRepartidor" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $repartidor->idrepartidor; ?>">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                </form>
                                <a href="/admin/ActualizarRepartidor?id=<?php echo $repartidor->idrepartidor; ?>" class="btn btn-sm btn-warning">Actualizar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
