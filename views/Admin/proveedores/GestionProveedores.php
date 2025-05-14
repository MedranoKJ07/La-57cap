<div class="card shadow-sm border-0">
    <div class="card-header text-white">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="card-title mb-0">Gestión de Proveedores</h2>
            </div>
            <div class="col-auto">
                <a href="/admin/CrearProveedor" class="btn btn-light text-primary fw-bold">
                    Crear Nuevo Proveedor
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <form method="POST" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar por empresa o contacto"
                value="<?php echo $busqueda ?? ''; ?>">
            <input type="submit" class="btn btn-primary" value="Filtrar">
            <a href="/admin/GestionarProveedores" class="btn btn-secondary">Limpiar</a>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Empresa</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Nacionalidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($proveedores)): ?>
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?php echo $proveedor->nombre_empresa ?? '—'; ?></td>
                            <td><?php echo $proveedor->contacto ?? '—'; ?></td>
                            <td><?php echo $proveedor->telefono ?? '—'; ?></td>
                            <td><?php echo $proveedor->direccion ?? '—'; ?></td>
                            <td>
                                <?php
                                if ($proveedor->nacionalidad == 'nacional') {
                                    echo '<span class="badge bg-success">Nacional</span>';
                                } elseif ($proveedor->nacionalidad == 'extranjera ' ) {
                                    echo '<span class="badge bg-info text-dark">Extranjera</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">No especificada</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="/admin/EliminarProveedor" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $proveedor->idProveedores; ?>">
                                        <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                    </form>
                                    <a href="/admin/ActualizarProveedor?id=<?php echo $proveedor->idProveedores; ?>"
                                        class="btn btn-sm btn-warning">Actualizar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">No se encontraron proveedores.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>