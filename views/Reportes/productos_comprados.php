<h2 class="text-center mb-4"><?= $titulo ?></h2>

<table class="table table-bordered table-hover text-center">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Total Comprado</th>
            <th>Costo Total (C$)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reporte as $fila): ?>
            <tr>
                <td><?= s($fila['nombre_producto']) ?></td>
                <td><?= $fila['total_comprado'] ?></td>
                <td>C$ <?= number_format($fila['costo_total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="mb-3 text-end">
    <a href="/admin/reporte/productos-comprados-pdf" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Exportar PDF
    </a>
    <a href="/admin/reporte/productos-comprados-excel" class="btn btn-success">
        <i class="fas fa-file-excel"></i> Exportar Excel
    </a>
</div>
