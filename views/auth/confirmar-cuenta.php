<main class="d-flex w-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-center mt-4">
                                <h1 class="h2">¡Cuenta confirmada!</h1>
                                <p class="lead">
                                    Tu cuenta ha sido verificada correctamente. Ya podés iniciar sesión.
                                </p>
                            </div>
                            <div style="text-align: center;">
                                <img src="/build/img/logo.png" alt="Logo" width="200" height="200"
                                    style="border-radius: 50%;">
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <?php include_once __DIR__ . "/../templates/alertas.php"; ?>
                            <a href="/login" class="btn btn-lg btn-primary mt-3">Iniciar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>