
<div class="card">
    <div class="card-header">
        <div class="row">
            <?php include_once __DIR__ . "/../../templates/alertas.php"; ?>
            <div class="col mt-0">
                <h2 class="card-title">Crear Usuario</h2>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="/admin/CrearUsuario" class="formulario" id="formulario"
            enctype="multipart/form-data">
            <?php include_once __DIR__ . "/../../formularios/Usuario.php"; ?>
            <input type="submit" value="Crear Usuario" class="btn btn-primary">
        </form>
    </div>
</div>