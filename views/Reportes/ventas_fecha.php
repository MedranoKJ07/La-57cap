<h2><?= $titulo ?></h2>

<form method="GET" class="row mb-4">
    <div class="col-md-4">
        <label>Desde:</label>
        <input type="date" name="inicio" value="<?= $fechaInicio ?>" class="form-control">
    </div>
    <div class="col-md-4">
        <label>Hasta:</label>
        <input type="date" name="fin" value="<?= $fechaFin ?>" class="form-control">
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button class="btn btn-primary w-100"><i class="fas fa-search"></i> Filtrar</button>
    </div>
</form>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Fecha</th>
            <th>Total Ventas</th>
            <th>Monto Total (C$)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reporte as $venta): ?>
            <tr>
                <td><?= $venta['fecha'] ?></td>
                <td><?= $venta['total_ventas'] ?></td>
                <td>C$ <?= number_format($venta['monto_total'] ?? 0, 2) ?></td>
            </tr>
        <?php endforeach; ?>



    </tbody>
</table>

<a href="/admin/reporte/ventas-fecha-pdf?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" class="btn btn-danger me-2">
    <i class="fas fa-file-pdf"></i> Descargar PDF
</a>
<a href="/admin/reporte/ventas-fecha-excel?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Descargar Excel
</a>
<script>
    document.querySelector('form').addEventListener('submit', function (e) {
        const inicio = document.querySelector('input[name="inicio"]').value;
        const fin = document.querySelector('input[name="fin"]').value;

        const hoy = new Date().toISOString().split('T')[0]; // Fecha actual en formato yyyy-mm-dd

        if (inicio && fin) {
            if (inicio > fin) {
                e.preventDefault();
                alert('La fecha de inicio no puede ser mayor que la fecha de fin.');
                return;
            }

            if (fin > hoy) {
                e.preventDefault();
                alert('La fecha de fin no puede ser mayor que la fecha actual.');
                return;
            }
        }
    });
</script>