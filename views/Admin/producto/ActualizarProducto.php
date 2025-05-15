<div class="card">
    <div class="card-header">
        <div class="row">
            <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
            <div class="col mt-0">
                <h2 class="card-title">Actualizar Producto</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" class="formulario">
            <?php include_once __DIR__ . "/../../formularios/Producto.php"; ?>
            <input type="submit" value="Actualizar Producto" class="btn btn-primary">
        </form>
    </div>
</div>
