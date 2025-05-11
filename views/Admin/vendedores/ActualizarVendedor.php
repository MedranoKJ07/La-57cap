<div class="card">
    <div class="card-header">
        <div class="row">
            <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
            <div class="col mt-0">
                <h2 class="card-title">Actualizar Vendedor</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" class="formulario" id="formulario"
            enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../../formularios/Vendedor.php"; ?>
            <input type="submit" value="Actualizar Vendedor" class="btn btn-primary">
        </form>
    </div>
</div>