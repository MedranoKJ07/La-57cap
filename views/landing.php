<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="build/img/gorras.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-primary"><b>La 57</b> Cap</h1>
                            <h3 class="h2">No es solo una gorra, es tu actitud</h3>
                            <p>
                                Encuentra el accesorio que habla por ti. ¡<b>La 57</b> Cap!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="build/img/outfit.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Outfit completo</h1>
                            <h3 class="h2">Vestite como pensás: sin miedo y con flow</h3>
                            <p>
                                Camisetas, fajas y ropa que rompen con lo común. ¡Auténtico desde la calle!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="build/img/accesorios.png" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Potenciá tu celular</h1>
                            <h3 class="h2">Tu celular es parte de tu flow... que no ande simple</h3>
                            <p>
                                Estuches, grips, cargadores y más con el estilo que tu teléfono se merece.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
        role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Categorías del Mes</h1>
            <p>
                ¡Explora lo más buscado del mes! Moda, estilo y más.
            </p>
        </div>
    </div>
    <div class="row">
        <?php foreach ($categoriasMes as $categoria): ?>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="/productos?categoria=<?php echo $categoria->idcategoria_producto; ?>">
                    <img src="/img/categorias_productos/<?php echo  s(trim($categoria->foto)); ?>"
                        class="rounded-circle img-fluid border" alt="Categoría">
                </a>
                <h5 class="text-center mt-3 mb-3"><?php echo s($categoria->titulo); ?></h5>
                <p class="text-center">
                    <a class="btn btn-success" href="/tienda?categoria=<?php echo $categoria->idcategoria_producto; ?>">
                        Ver Productos
                    </a>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Productos Destacados</h1>
                <p>Descubre los productos más valorados por nuestros clientes.</p>
            </div>
        </div>
        <div class="row">
            <?php foreach ($productosDestacados as $producto): ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="/producto?id=<?php echo $producto->idproducto; ?>">
                            <img src="/img/productos/<?php echo s($producto->Foto ?? 'default.jpg'); ?>" class="card-img-top" alt="<?php echo s($producto->nombre_producto); ?>">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <!-- <?php for ($i = 0; $i < 5; $i++): ?>
                                        <i class="fa <?php echo $i < rand(3, 5) ? 'fa-star text-warning' : 'fa-star text-muted'; ?>"></i>
                                    <?php endfor; ?> -->
                                </li>
                                <li class="text-muted text-right">C$<?php echo number_format($producto->precio, 2); ?></li>
                            </ul>
                            <a href="/producto?id=<?php echo $producto->idproducto; ?>" class="h2 text-decoration-none text-dark"><?php echo s($producto->nombre_producto); ?></a>
                            <p class="card-text text-muted small">
                                <?php echo substr(s($producto->descripcion), 0, 100) . '...'; ?>
                            </p>
                            <!-- <p class="text-muted">Reviews (<?php echo rand(10, 80); ?>)</p> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- End Featured Product -->