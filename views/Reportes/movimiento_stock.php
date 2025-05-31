<h2><?= $titulo ?></h2>
<form method="GET" class="mb-4">
    <label>Desde:</label>
    <input type="date" name="inicio" value="<?= $fechaInicio ?>">
    <label class="ms-3">Hasta:</label>
    <input type="date" name="fin" value="<?= $fechaFin ?>">
    <button type="submit" class="btn btn-primary ms-2">Filtrar</button>
</form>

<div class="mb-3">
    <a href="/admin/reportes/movimiento-stock-pdf?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" target="_blank" class="btn btn-danger me-2">
        <i class="fas fa-file-pdf me-1"></i> Exportar PDF
    </a>
    <a href="/admin/reportes/movimiento-stock-excel?inicio=<?= $fechaInicio ?>&fin=<?= $fechaFin ?>" class="btn btn-success">
        <i class="fas fa-file-excel me-1"></i> Exportar Excel
    </a>
</div>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Entradas (Compras)</th>
            <th>Salidas (Ventas)</th>
            <th>Saldo Neto</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reporte as $item): ?>
            <tr>
                <td><?= s($item['nombre_producto']) ?></td>
                <td><?= $item['cantidad_comprada'] ?></td>
                <td><?= $item['cantidad_vendida'] ?></td>
                <td><?= $item['cantidad_comprada'] - $item['cantidad_vendida'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
