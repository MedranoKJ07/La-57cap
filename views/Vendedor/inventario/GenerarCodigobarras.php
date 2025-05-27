<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title mb-0">Código de Barras</h2>
        <a href="/vendedor/inventario" class="btn btn-outline-secondary">← Volver</a>
    </div>

    <div class="card-body text-center">
        <h4 class="mb-4"><?php echo $producto->nombre_producto; ?></h4>

        <img src="data:image/png;base64,<?php echo $barcode; ?>" alt="Código de barras" class="img-fluid mb-3" style="max-height: 120px;">

        <p class="mb-3">Código del producto:
            <strong class="text-primary"><?php echo $codigo; ?></strong>
        </p>

        <div class="d-flex justify-content-center gap-2 mt-3">
            <a href="/vendedor/DescargarCodigoBarras?formato=png&id=<?php echo $producto->idproducto; ?>" class="btn btn-sm btn-primary">Exportar PNG</a>
            <a href="/vendedor/DescargarCodigoBarras?formato=svg&id=<?php echo $producto->idproducto; ?>" class="btn btn-sm btn-success">Exportar SVG</a>
            <a href="/vendedor/DescargarCodigoBarras?formato=pdf&id=<?php echo $producto->idproducto; ?>" class="btn btn-sm btn-danger">Exportar PDF</a>
        </div>
    </div>
</div>
