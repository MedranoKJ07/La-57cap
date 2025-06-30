<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Garantía</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 12px;
            margin: 40px;
            color: #333;
        }

        header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .logo {
            width: 100px;
            margin-bottom: 10px;
        }

        .titulo-principal {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitulo {
            font-size: 14px;
            margin-top: 5px;
        }

        .seccion {
            margin-bottom: 30px;
        }

        .seccion h3 {
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 4px;
        }

        .info-label {
            font-weight: bold;
        }

        .producto {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
        }

        .footer {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 10px;
            font-size: 11px;
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <img src="data:image/png;base64,<?= $logoBase64 ?>" class="logo" alt="Logo">
    <div class="titulo-principal">CERTIFICADO DE GARANTÍA DE PRODUCTOS</div>
    <div class="subtitulo">Informe detallado por venta N.º <?= $venta->idventas ?></div>
</header>

<section class="seccion">
    <h3>Datos del Cliente</h3>
    <p><span class="info-label">Nombre:</span> <?= $cliente ? "{$cliente->p_nombre} {$cliente->s_nombre} {$cliente->p_apellido} {$cliente->s_apellido}" : $nombreCliente ?></p>
    <p><span class="info-label">Teléfono:</span> <?= $cliente ? $cliente->n_telefono : 'N/D' ?></p>
    <p><span class="info-label">Dirección:</span> <?= $cliente ? $cliente->direccion . ', ' . $cliente->Municipio : 'N/D' ?></p>
    <p><span class="info-label">Fecha de la venta:</span> <?= date('d/m/Y', strtotime($venta->creado)) ?></p>
</section>

<section class="seccion">
    <h3>Productos Cubiertos por Garantía</h3>

    <?php foreach ($productosConGarantia as $item): ?>
        <div class="producto">
            <p><span class="info-label">Producto:</span> <?= $item['producto']->nombre_producto ?></p>
            <p><span class="info-label">Categoría:</span> <?= $item['categoria']->titulo ?></p>
            <p><span class="info-label">Cantidad vendida:</span> <?= $item['cantidad'] ?></p>
            <p><span class="info-label">Duración de la garantía:</span> <?= $item['categoria']->garantias_meses ?> meses</p>
            <p><span class="info-label">Condiciones de Garantía:</span><br>
                <?= nl2br(htmlentities($item['categoria']->politica_garantia)) ?>
            </p>
        </div>
    <?php endforeach; ?>
</section>

<div class="footer">
    Este informe ha sido generado automáticamente por el sistema de ventas de La 57 CAP.  
    Para hacer uso de la garantía, el cliente deberá presentar este certificado junto con el producto.  
    <br><br>
    <strong>La 57 CAP © <?= date('Y') ?></strong>
</div>

</body>
</html>
