<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h2 class="card-title mb-0">Gestión de Categorías de Productos</h2>
        <a href="/admin/CrearCategoriaProducto" class="btn btn-light text-primary fw-bold">Crear Nueva Categoría</a>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <form method="POST" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar categoría o política"
                value="<?php echo $busqueda ?? ''; ?>">
            <input type="submit" class="btn btn-primary" value="Filtrar">
            <a href="/admin/GestionarCategoriaProducto" class="btn btn-secondary">Limpiar</a>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Título</th>
                        <th>Image</th>
                        <th>Meses Garantía</th>
                        <th>Política de Garantía</th>
                        <th>Tiene Garantía</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categorias)): ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <tr>
                                <td><?php echo $categoria->titulo; ?></td>
                                <td>
                                    <img src="/img/categorias_productos/<?php echo s(trim($categoria->foto)); ?>" alt="Foto" width="40" height="40" style="border-radius: 50%;">
                                </td>
                                <td><?php echo $categoria->garantias_meses; ?> meses</td>
                                <td><?php echo $categoria->politica_garantia; ?></td>
                                <td><?php echo $categoria->tiene_garantia ? 'Sí' : 'No'; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $categoria->estado ? 'success' : 'secondary'; ?>">
                                        <?php echo $categoria->estado ? 'Activo' : 'Inactivo'; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/admin/ActualizarCategoriaProducto?id=<?php echo $categoria->idcategoria_producto; ?>"
                                            class="btn btn-sm btn-warning">Actualizar</a>
                                        <form method="POST" action="/admin/EliminarCategoriaProducto" class="d-inline">
                                            <input type="hidden" name="id"
                                                value="<?php echo $categoria->idcategoria_producto; ?>">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No se encontraron categorías.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>