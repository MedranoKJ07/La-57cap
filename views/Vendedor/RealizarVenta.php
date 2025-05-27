<div class="card shadow-sm">
    <div class="card-header text-dark d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Realizar Venta</h4>
    </div>

    <div class="card-body">
        <form method="POST" action="/vendedor/realizar-venta" id="formVenta">
            <!-- Nombre del cliente -->
            <div class="mb-3">
                <label for="idCliente" class="form-label fw-semibold">Ingrese nombre del Cliente:</label>
                <input type="text" class="form-control" id="idCliente" name="nombre_cliente" placeholder="Nombre del Cliente"
                    value="<?= s($_POST['nombre_cliente'] ?? '') ?>" autofocus>
            </div>

            <!-- Checkbox: No tiene registro -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" name="cliente_sin_registro" id="clientenoTieneRegistro"
                    <?= isset($_POST['cliente_sin_registro']) ? 'checked' : '' ?>>
                <label class="form-check-label" for="clientenoTieneRegistro">
                    No tiene registro
                </label>
            </div>

            <?php if (isset($clienteEncontrado) && $clienteEncontrado): ?>
                <div class="alert alert-success">
                    <strong>Cliente encontrado:</strong><br>
                    Nombre: <?= s($clienteEncontrado->p_nombre . ' ' . $clienteEncontrado->s_nombre . ' ' . $clienteEncontrado->p_apellido . ' ' . $clienteEncontrado->s_apellido) ?><br>
                    Teléfono: <?= s($clienteEncontrado->n_telefono) ?><br>
                    Dirección: <?= s($clienteEncontrado->direccion) ?><br>
                    Municipio: <?= s($clienteEncontrado->Municipio) ?>
                </div>
            <?php elseif (isset($_POST['nombre_cliente']) && !$clienteEncontrado): ?>
                <div class="alert alert-warning">
                    Cliente no encontrado. Se utilizará cliente genérico.
                </div>
            <?php endif; ?>

            <!-- Aquí iría el resto del formulario (productos, totales, entrega, etc.) -->
            <p class="text-muted">Aquí puedes continuar con los campos de productos, totales, dirección, etc.</p>

            <button type="submit" class="btn btn-success">Finalizar Venta</button>
        </form>
    </div>
</div>
