<div class="card">
    <div class="card-header">
        <h2 class="card-title">Actualizar Categoría de Producto</h2>
    </div>
    <div class="card-body">
        <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
        <form method="POST" class="formulario">
            <?php include_once __DIR__ . "/../../formularios/CategoriaProducto.php"; ?>
            <input type="submit" value="Actualizar Categoría" class="btn btn-primary">
        </form>
    </div>
</div>