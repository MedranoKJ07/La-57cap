<div class="card">
    <div class="card-header">
        <h2 class="card-title">Crear Proveedor</h2>
    </div>
    <div class="card-body">
        <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
        <form method="POST" class="row g-3">
            <?php include_once __DIR__ . "/../../formularios/Proveedor.php"; ?>
            <div class="d-flex justify-content-between">
                <a href="/admin/GestionarProveedores" class="btn btn-secondary">Cancelar</a>
                <input type="submit" class="btn btn-primary" value="Crear Proveedor">
            </div>
        </form>
    </div>
</div>