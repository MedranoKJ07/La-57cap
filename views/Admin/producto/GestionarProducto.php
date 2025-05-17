<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Productos</h2>
        <a href="/admin/CrearProducto" class="btn btn-light text-primary fw-bold">Crear Nuevo Producto</a>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <form method="POST" class="d-flex gap-2 flex-wrap align-items-center">
            <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar por nombre o categoría"
                   value="<?php echo $busqueda ?? ''; ?>">

            <select name="categoria" class="form-select w-auto">
                <option value="">-- Todas las Categorías --</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria->idcategoria_producto; ?>"
                        <?php echo $categoriaSeleccionada == $categoria->idcategoria_producto ? 'selected' : ''; ?>>
                        <?php echo $categoria->titulo; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="submit" class="btn btn-primary" value="Filtrar">
            <a href="/admin/GestionarProducto" class="btn btn-secondary">Limpiar</a>
        </form>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto->codigo_producto; ?></td>
                                <td>
                                    <img src="/img/productos/<?php echo $producto->Foto ?? 'default.jpg'; ?>" width="40" height="40"
                                         class="rounded-circle" alt="Imagen producto">
                                </td>
                                <td><?php echo $producto->nombre_producto; ?></td>
                                <td><?php echo $producto->descripcion; ?></td>
                                <td><?php echo $producto->categoria_nombre ?? '—'; ?></td>
                                <td>$<?php echo number_format($producto->precio, 2); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $producto->eliminado ? 'secondary' : 'success'; ?>">
                                        <?php echo $producto->eliminado ? 'Inactivo' : 'Activo'; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="/admin/ActualizarProducto?id=<?php echo $producto->idproducto; ?>"
                                           class="btn btn-sm btn-warning">Actualizar</a>
                                        <form method="POST" action="/admin/EliminarProducto" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $producto->idproducto; ?>">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                        </form>
                                        <a href="/admin/GenerarCodigoBarras?id=<?php echo $producto->idproducto; ?>"
                                           class="btn btn-sm btn-outline-dark">Ver Código</a>
                                        <a href="/admin/VerProducto?id=<?php echo $producto->idproducto; ?>"
                                           class="btn btn-sm btn-outline-info">Ver Detalles</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">No se encontraron productos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
