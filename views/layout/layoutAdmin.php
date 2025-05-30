<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La57Cap Admin | <?php echo $titulo ?? ''; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>

    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="/admin">
                    <span class="align-middle">La 57 Cap</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/Dashboard">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Gestionar usuarios
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarUsuario">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Usuarios</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarVendedores">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Vendedor</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarRepartidor">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Repartidor</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarCliente">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Cliente</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Gestion inventario
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarCategoriaProducto">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Categorias Productos</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarProducto">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Productos</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/InventarioGeneral">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Inventario</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Gestionar Compras
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarProveedores">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Proveedores</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/GestionarCompras">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Compras
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Gestionar Devoluciones
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/devoluciones">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Devoluciones
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Gestionar Ventas - Pedidos
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/historialPedidos">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Pedidos
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/admin/calificaciones">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">
                                Calificaciones Pedidos
                            </span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <?php
                    use Model\Notificacion;
                    $notificaciones = [];
                    if (isset($_SESSION['id'])) {
                        $notificaciones = Notificacion::obtenerPorUsuarioUltimas4($_SESSION['id']);
                    }
                    ?>
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator"><?= count($notificaciones) ?></span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    <?= count($notificaciones) ?> Notificaciones
                                </div>
                                <div class="list-group">
                                    <?php foreach ($notificaciones as $noti): ?>
                                        <a href="#" class="list-group-item">
                                            <div class="row g-0 align-items-center">
                                                <div class="col-2">
                                                    <i class="text-info" data-feather="bell"></i>
                                                </div>
                                                <div class="col-10">
                                                    <div class="text-dark"><?= htmlspecialchars($noti->titulo) ?></div>
                                                    <div class="text-muted small mt-1">
                                                        <?= htmlspecialchars($noti->descripcion) ?>
                                                    </div>
                                                    <div class="text-muted small mt-1">
                                                        <?= date('d/m/Y H:i', strtotime($noti->creada_fecha)) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="/notificaciones" class="text-muted">Ver todas</a>
                                </div>
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <?php
                            $nombreUsuario = $_SESSION['nombre'] ?? 'Administrador';
                            $fotoPerfil = $_SESSION['f_perfil'] ?? 'f_perfil_admin.png';
                            $rutaPerfil = "/img/users/" . $fotoPerfil;
                            ?>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="<?php echo $rutaPerfil; ?>" class="avatar img-fluid rounded me-1"
                                    alt="Foto de perfil" />
                                <span class="text-dark"><?php echo htmlspecialchars($nombreUsuario); ?></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="pie-chart"></i>
                                    Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                                        data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1"
                                        data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="form-check form-switch ms-3">
                    <input type="checkbox" id="darkModeSwitch" onchange="toggleDarkMode()">
                    <label for="darkModeSwitch" class="toggle-icon"></label>
                </div>
            </nav>
            <main class="content">
                <div class="container-fluid p-0">

                    <?php echo $contenido; ?>


                </div>
            </main>

        </div>
    </div>



</body>
<script src='/build/js/app.js'></script>

</html>