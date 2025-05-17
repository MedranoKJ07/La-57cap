<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Registrar Nueva Compra</h2>
        <button type="button" id="agregar-producto" class="btn btn-outline-secondary">Agregar Producto</button>
    </div>
    <?php include_once __DIR__ . '/../../templates/alertas.php'; ?>
    <div class="card-body">
        <form method="POST" id="form-compra">
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select name="compra[Proveedores_idProveedores]" id="proveedor" class="form-select" required>
                    <option value="">-- Selecciona --</option>
                    <?php foreach ($proveedores as $prov): ?>
                        <option value="<?= s($prov->idProveedores) ?>"><?= s($prov->nombre_empresa) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr>
            <h5>Productos</h5>
            <div id="contenedor-productos">
                <!-- Aquí se agregarán dinámicamente productos con JS -->
            </div>

            <input type="submit" value="Registrar Compra" class="btn btn-primary mt-3">
        </form>
    </div>
</div>

<script>
    const productos = <?php echo json_encode($productos); ?>;
    let index = 0;

    document.getElementById('agregar-producto').addEventListener('click', () => {
        const contenedor = document.getElementById('contenedor-productos');

        const seleccionados = Array.from(document.querySelectorAll('[name*="[producto_id]"]')).map(sel => sel.value);
        if (seleccionados.includes('')) {
            alert("Completa los productos agregados antes de añadir más.");
            return;
        }

        const row = document.createElement('div');
        row.classList.add('row', 'mb-3', 'align-items-end');
        row.setAttribute('data-index', index);

        row.innerHTML = `
            <div class="col-md-5">
                <label class="form-label">Producto</label>
                <select name="detalle[${index}][producto_idproducto]" class="form-select producto-select" required>
                    <option value="">-- Selecciona --</option>
                    ${productos.map(p => `<option value="${p.idproducto}">${p.nombre_producto}</option>`).join('')}
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Cantidad</label>
                <input type="number" name="detalle[${index}][cantidad]" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Precio Unitario</label>
                <input type="number" name="detalle[${index}][precio]" class="form-control" step="0.01" required>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger eliminar-producto">&times;</button>
            </div>
        `;

        contenedor.appendChild(row);
        index++;
    });

    document.getElementById('contenedor-productos').addEventListener('click', function (e) {
        if (e.target.classList.contains('eliminar-producto')) {
            e.target.closest('.row').remove();
        }
    });

    document.getElementById('form-compra').addEventListener('submit', function (e) {
        const seleccionados = Array.from(document.querySelectorAll('[name*="[producto_id]"]')).map(sel => sel.value);
        const unicos = new Set(seleccionados);

        if (unicos.size !== seleccionados.length) {
            e.preventDefault();
            alert('No puedes registrar productos duplicados en una misma compra.');
        }
    });
</script>