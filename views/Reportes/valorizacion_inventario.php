<h2 class="mb-4"><?= $titulo ?></h2>

<table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Producto</th>
            <th>Precio Unitario (C$)</th>
            <th>Cantidad en Stock</th>
            <th>Valor Total (C$)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datos as $fila): ?>
            <tr>
                <td><?= s($fila['nombre_producto']) ?></td>
                <td><?= number_format($fila['precio'], 2) ?></td>
                <td><?= $fila['cantidad_actual'] ?></td>
                <td><?= number_format($fila['valor_total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="mt-3">
    <a href="/admin/reporte/valorizacion-inventario-pdf" class="btn btn-danger">Exportar PDF</a>
    <a href="/admin/reporte/valorizacion-inventario-excel" class="btn btn-success">Exportar Excel</a>
</div>
