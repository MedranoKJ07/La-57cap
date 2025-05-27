<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Detalles del Producto</h2>
        <a href="/vendedor/inventario" class="btn btn-secondary">Volver a Productos</a>
    </div>
    <div class="card-body row g-4">
        <div class="col-md-4 text-center">
            <img width="200px" src="/img/productos/<?= $producto->Foto ?? 'default.jpg' ?>" alt="Imagen del producto">
        </div>
        <div class="col-md-8">
            <dl class="row mb-0">
                <dt class="col-sm-4">Código:</dt>
                <dd class="col-sm-8"><?= $producto->codigo_producto ?></dd>

                <dt class="col-sm-4">Nombre:</dt>
                <dd class="col-sm-8"><?= $producto->nombre_producto ?></dd>

                <dt class="col-sm-4">Descripción:</dt>
                <dd class="col-sm-8"><?= $producto->descripcion ?></dd>

                <dt class="col-sm-4">Precio:</dt>
                <dd class="col-sm-8">C$<?= number_format($producto->precio, 2) ?></dd>

                <dt class="col-sm-4">Categoría:</dt>
                <dd class="col-sm-8"><?= $producto->categoria_nombre ?? 'No especificada' ?></dd>

                <dt class="col-sm-4">Estado:</dt>
                <dd class="col-sm-8">
                    <span class="badge bg-<?= $producto->eliminado ? 'secondary' : 'success' ?>">
                        <?= $producto->eliminado ? 'Inactivo' : 'Activo' ?>
                    </span>
                </dd>
            </dl>
        </div>
    </div>
</div>
