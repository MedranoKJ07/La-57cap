<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La 57 Cap | <?php echo $titulo ?? ''; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <link rel="stylesheet" href="/build/css/bootstrap.min.css">
    <link rel="stylesheet" href="/build/css/templatemo.css">
    <link rel="stylesheet" href="/build/css/custom.css">
    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="/build/css/fontawesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-dark">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-dark text-decoration-none"
                        href="mailto:info@company.com">correo@correo.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-dark text-decoration-none" href="tel:010-020-0340">NUMERO</a>
                </div>
                <div>
                    <a class="text-dark" href="https://fb.com/templatemo" target="_blank" rel="sponsored">
                        <i class="fab fa-facebook-f fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-dark" href="https://www.instagram.com/" target="_blank">
                        <i class="fab fa-instagram fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-dark" href="https://twitter.com/" target="_blank">
                        <i class="fab fa-twitter fa-sm fa-fw me-2"></i>
                    </a>
                    <a class="text-dark" href="https://www.linkedin.com/" target="_blank">
                        <i class="fab fa-linkedin fa-sm fa-fw"></i>
                    </a>


                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->



    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-primary logo h1 align-self-center" href="/">
                La 57 Cap
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
                id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/SobreNosotros">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/tienda">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/Contactanos">Contact</a>
                        </li>
                    </ul>
                    <ul>

                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                        data-bs-target="#templatemo_search">
                        <i class="fa fa-fw fa-search text-dark mr-2"></i>
                    </a>
                    <a class="nav-icon position-relative text-decoration-none" href="/carrito">
                        <i class="fa fa-fw fa-cart-arrow-down text-dark me-1"></i>
                        <?php if (!empty($carritoCantidad)): ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                                <?= $carritoCantidad ?>
                            </span>
                        <?php endif; ?>
                    </a>
                    <div class="dropdown">
                        <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#"
                            role="button" id="usuarioMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i>
                            <?php if (!empty($_SESSION['autenticado_Cliente'])): ?>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                                    <?= $_SESSION['nombre'][0] ?? '+' ?>
                                </span>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usuarioMenu">
                            <?php if (!empty($_SESSION['autenticado_Cliente'])): ?>
                                <li><a class="dropdown-item" href="/cliente/pedidos">Mis Pedidos</a></li>
                                <li><a class="dropdown-item" href="/logout">Cerrar Sesión</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="/login">Iniciar Sesión</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>


                </div>
            </div>

        </div>
        <div class="form-check form-switch ms-3">
            <input type="checkbox" id="darkModeSwitch" onchange="toggleDarkMode()">
            <label for="darkModeSwitch" class="toggle-icon"></label>
        </div>
       

    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php echo $contenido; ?>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-primary border-bottom pb-3 border-light logo">La 57 Cap</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            UBICACION
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="#">NUMERO</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="#">correo@correo.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Categorias Productos</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php foreach ($categorias as $categoria): ?>
                            <li>
                                <a class="text-decoration-none"
                                    href="/productos?categoria=<?php echo $categoria->idcategoria_producto; ?>">
                                    <?php echo s($categoria->titulo); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>


                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">About</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="/">Home</a></li>
                        <li><a class="text-decoration-none" href="/SobreNosotros">About Us</a></li>
                        <li><a class="text-decoration-none" href="/">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                    class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                    class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <?php $año = date('Y') ?>
                        <p class="text-left text-light">
                            Copyright &copy; La 57 Cap <?php echo $año ?> &copy;</p>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->
</body>
<script src='/build/js/app.js'></script>
<script src="/build/js/jquery-1.11.0.min.js"></script>
<script src="/build/js/jquery-migrate-1.2.1.min.js"></script>
<script src="/build/js/bootstrap.bundle.min.js"></script>
<script src="/build/js/templatemo.js"></script>
<script src="/build/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</html>