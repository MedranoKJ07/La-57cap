<div class="card">
    <div class="card-header">
        <h2 class="card-title">Crear Categoría de Producto</h2>
    </div>
    <div class="card-body">
        <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
        <form method="POST" action="/admin/CrearCategoriaProducto" class="formulario" id="formulario"
            enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../../formularios/CategoriaProducto.php"; ?>
            <input type="submit" value="Crear Categoría" class="btn btn-success">
        </form>
    </div>
</div>