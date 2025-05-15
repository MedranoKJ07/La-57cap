<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Gestión de Productos</h2>
        <a href="/admin/CrearProducto" class="btn btn-light text-primary fw-bold">Crear Nuevo Producto</a>
    </div>
</div>

<div class="card mt-3">
    <div class="card-header">
        <form method="POST" action="" class="d-flex gap-2 flex-wrap align-items-center">
            <select name="categoria" class="form-select w-auto">
                <option value="">-- Categoría --</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?php echo $cat->idcategoria_producto; ?>"
                        <?php echo ((string)$cat->idcategoria_producto === (string)$categoriaSeleccionada) ? 'selected' : ''; ?>>
                        <?php echo $cat->titulo; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="busqueda" class="form-control w-auto" placeholder="Buscar por nombre o código"
                   value="<?php echo $busqueda; ?>">

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
                        <th>Foto</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($productos)): ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td><?php echo $producto->codigo_producto; ?></td>
                                <td>
                                    <img src="/img/productos/<?php echo $producto->Foto; ?>" alt="Foto"
                                         width="40" height="40" style="border-radius: 50%;">
                                </td>
                                <td><?php echo $producto->nombre_producto; ?></td>
                                <td><?php echo $producto->descripcion; ?></td>
                                <td><?php echo $producto->categoria ?? 'Sin categoría'; ?></td>
                                <td>$<?php echo number_format($producto->precio, 2); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/admin/ActualizarProducto?id=<?php echo $producto->idproducto; ?>"
                                           class="btn btn-sm btn-warning">Actualizar</a>
                                        <form method="POST" action="/admin/EliminarProducto" class="d-inline">
                                            <input type="hidden" name="id" value="<?php echo $producto->idproducto; ?>">
                                            <input type="submit" class="btn btn-sm btn-danger" value="Eliminar">
                                        </form>
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
