<h2><?= $titulo ?></h2>
<form method="GET" class="mb-4">
    <label>Desde:</label>
    <input type="date" name="inicio" value="<?= $fechaInicio ?>">
    <label class="ms-3">Hasta:</label>
    <input type="date" name="fin" value="<?= $fechaFin ?>">
    <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
</form>

<div class="mb-3">
    <a href="/admin/reportes/ventas-producto-pdf?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" target="_blank" class="btn btn-danger me-2">
        <i class="fas fa-file-pdf me-1"></i> Exportar a PDF
    </a>
    <a href="/admin/reportes/ventas-producto-excel?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" class="btn btn-success">
        <i class="fas fa-file-excel me-1"></i> Exportar a Excel
    </a>
</div>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Total Vendidos</th>
            <th>Monto Total (C$)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reporte as $r): ?>
            <tr>
                <td><?= s($r['nombre_producto']) ?></td>
                <td><?= $r['total_vendidos'] ?></td>
                <td>C$ <?= number_format($r['monto_total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
