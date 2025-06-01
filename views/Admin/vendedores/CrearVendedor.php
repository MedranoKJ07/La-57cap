<div class="card">
    <div class="card-header">
        <h2 class="card-title">Crear Vendedor</h2>
    </div>

    <div class="card-body">
        <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>

        <form method="POST" class="row g-3" enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../../formularios/Vendedor.php"; ?>

            <div class="col-12 d-flex justify-content-between">

                


                <input type="submit" class="btn btn-primary" value="Guardar Vendedor">
            </div>
        </form>
    </div>
</div>