<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            <img src="/img/productos/<?= s($producto->Foto) ?>" class="img-fluid"
                 alt="<?= s($producto->nombre_producto) ?>">
        </div>
        <div class="col-md-6">
            <h2><?= s($producto->nombre_producto) ?></h2>
            <p class="lead">C$ <?= number_format($producto->precio, 2) ?></p>
            <p><?= s($producto->descripcion) ?></p>

            <a href="/carrito/agregar?id=<?= $producto->idproducto ?>" class="btn btn-success">
                <i class="fas fa-cart-plus"></i> Agregar al Carrito
            </a>

            <a href="/tienda" class="btn btn-outline-secondary ms-2">
                <i class="fas fa-arrow-left"></i> Volver a la tienda
            </a>
        </div>
    </div>
</div>
