<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">¿Olvidaste tu contraseña?</h1>
            <p class="lead">
              Ingresá tu correo y te enviaremos un enlace para reestablecerla
            </p>
          </div>

          <div class="card">
            <div class="card-header text-center">
              <img src="/build/img/logo.png" alt="Logo" width="120" height="120" style="border-radius: 50%;">
            </div>

            <div class="card-body">
              <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

              <form method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Correo electrónico</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Tu email" required>
                </div>

                <div class="d-grid gap-2 mt-4">
                  <input type="submit" class="btn btn-primary btn-lg" value="Enviar Instrucciones">
                </div>
              </form>
            </div>

            <div class="text-center mb-3">
              ¿Ya tienes una cuenta? <a href="/login">Iniciar sesión</a>
            </div>
            <div class="text-center mb-3">
              ¿No tienes cuenta aún? <a href="/crear-cuenta">Crear una</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
