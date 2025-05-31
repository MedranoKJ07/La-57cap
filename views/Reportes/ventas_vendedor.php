<h2><?= $titulo ?></h2>

<form method="GET" class="row g-3 mb-4">
    <div class="col-md-5">
        <label for="inicio" class="form-label">Desde:</label>
        <input type="date" id="inicio" name="inicio" value="<?= s($fechaInicio) ?>" class="form-control">
    </div>
    <div class="col-md-5">
        <label for="fin" class="form-label">Hasta:</label>
        <input type="date" id="fin" name="fin" value="<?= s($fechaFin) ?>" class="form-control">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button class="btn btn-primary w-100" type="submit">Filtrar</button>
    </div>
</form>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Vendedor</th>
            <th>Total Ventas</th>
            <th>Monto Total (C$)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reporte as $fila): ?>
            <tr>
                <td><?= s($fila['nombre_vendedor']) ?></td>
                <td><?= $fila['total_ventas'] ?></td>
                <td>C$ <?= number_format($fila['monto_total'] ?? 0, 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="mb-3">
    <a href="/admin/reportes/ventas-vendedor-pdf?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" target="_blank"
        class="btn btn-danger me-2">
        <i class="fas fa-file-pdf me-1"></i> Exportar a PDF
    </a>
    <a href="/admin/reportes/ventas-vendedor-excel?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>"
        class="btn btn-success">
        <i class="fas fa-file-excel me-1"></i> Exportar a Excel
    </a>
</div>