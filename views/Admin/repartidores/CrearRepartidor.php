<div class="card">
    <div class="card-header">
        <h2 class="card-title">Registrar Repartidor</h2>
    </div>

    <div class="card-body">
        <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>

        <form method="POST" class="row g-3">
            <?php include_once __DIR__ . "/../../formularios/Repartidor.php"; ?>
            <div class="d-flex justify-content-between">


                <input type="submit" class="btn btn-success" value="Guardar Repartidor">
            </div>
        </form>
    </div>
</div>