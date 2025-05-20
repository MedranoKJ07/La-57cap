<div class="container py-5">
    <div class="row">

        <!-- SIDEBAR IZQUIERDO -->
        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categorías</h1>
            <ul class="list-unstyled templatemo-accordion">
                <li class="pb-2">
                    <a class="h5 text-decoration-none" href="/tienda">Todas</a>
                </li>
                <?php foreach ($categorias as $categoria): ?>
                    <li class="pb-2">
                        <a class="h5 text-decoration-none" href="/tienda?categoria=<?= $categoria->idcategoria_producto ?>">
                            <?= s($categoria->titulo) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <!-- FILTROS BÁSICOS -->
            <form method="GET" action="/tienda">
                <?php if (isset($_GET['categoria'])): ?>
                    <input type="hidden" name="categoria" value="<?= s($_GET['categoria']) ?>">
                <?php endif; ?>
                <div class="form-group mt-4">
                    <label for="buscar">Buscar</label>
                    <input type="text" name="buscar" id="buscar" class="form-control"
                        value="<?= s($_GET['buscar'] ?? '') ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="orden">Ordenar por</label>
                    <select name="orden" id="orden" class="form-control">
                        <option value="">-- Seleccionar --</option>
                        <option value="asc" <?= ($_GET['orden'] ?? '') === 'asc' ? 'selected' : '' ?>>Precio ascendente
                        </option>
                        <option value="desc" <?= ($_GET['orden'] ?? '') === 'desc' ? 'selected' : '' ?>>Precio descendente
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Aplicar filtros</button>
            </form>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-lg-9">
            <div class="row">
                <?php if (empty($productos)): ?>
                    <div class="col-12">
                        <p>No hay productos disponibles.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-md-4">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid"
                                        src="/img/productos/<?= s(trim($producto->Foto)) ?>"
                                        alt="<?= s($producto->nombre_producto) ?>">
                                    <div
                                        class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">
                                            <li>
                                                <a class="btn btn-light text-dark" href="#">
                                                    <i class="far fa-heart"></i> <!-- Wishlist -->
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-success text-white mt-2"
                                                    href="/producto?id=<?= $producto->idproducto ?>">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="btn btn-success text-white mt-2"
                                                    href="/carrito/agregar?id=<?= $producto->idproducto ?>">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="/producto?id=<?= $producto->idproducto ?>"
                                        class="h3 text-decoration-none"><?= s($producto->nombre_producto) ?></a>
                                    <p class="text-center mb-0">C$ <?= number_format($producto->precio, 2) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Paginación -->
            <div class="row mt-4">
                <div class="col d-flex justify-content-center">
                    <nav>
                        <ul class="pagination">
                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                <?php
                                // Conservar filtros en los enlaces
                                $params = $_GET;
                                $params['pagina'] = $i;
                                $url = '/tienda?' . http_build_query($params);
                                ?>
                                <li class="page-item <?= $i === $paginaActual ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $url ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>

    </div>
</div>