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
            <div class="sidebar-content js-simplebar bg-dark text-white">
                <a class="sidebar-brand" href="/Repartidor">
                    <img src="/img/logo.png" alt="logo" width="80px">
                    <span class="align-middle">La 57 Cap</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Gestionar entregas
                    </li>
                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="/repartidor/pedidos-en-camino">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Pedidos
                                asignados
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
                    <ul class="navbar-nav navbar-align">
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
                                    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown"
                                        data-bs-toggle="dropdown">
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
                                                            <div class="text-dark"><?= htmlspecialchars($noti->titulo) ?>
                                                            </div>
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
                                    $nombre = $_SESSION['nombre'] ?? 'Invitado';

                                    $foto = !empty($_SESSION['f_perfil']) ? '/img/users/' . $_SESSION['f_perfil'] : '/img/users/f_perfil_admin.png';
                                    ?>

                                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                        data-bs-toggle="dropdown">
                                        <img src="<?php echo $foto; ?>" class="avatar img-fluid rounded me-1"
                                            alt="Perfil" />
                                        <span class="text-dark"><?php echo $nombre; ?></span>
                                    </a>


                                    <div class="dropdown-menu dropdown-menu-end">

                                        <a class="dropdown-item" href="/logout"><i class="align-middle me-1"
                                                data-feather="log-out"></i> Cerrar sesión</a>

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