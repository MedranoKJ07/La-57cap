<div class="card">
    <div class="card-header">
        <div class="row">
            <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
            <div class="col mt-0">
                <h2 class="card-title">Crear Producto</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/CrearProducto" class="formulario" enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../../formularios/Producto.php"; ?>
            <input type="submit" value="Crear Producto" class="btn btn-primary">
        </form>
    </div>
</div>
