<div class="card shadow-sm border-0">
    <div class="card-header text-white">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="card-title mb-0">Actualizar Repartidor</h2>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>

    <div class="card-body">
        <form method="POST" id="formulario" enctype="multipart/form-data" class="row g-3">
            <?php include_once __DIR__ . "/../../formularios/Repartidor.php"; ?>

            <div class="d-flex justify-content-between mt-4">
                
                <button type="submit" class="btn btn-primary">
                    Actualizar Usuario
                </button>
            </div>
        </form>
    </div>
</div>
