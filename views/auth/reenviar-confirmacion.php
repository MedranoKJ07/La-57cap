<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">¿No recibiste tu correo?</h1>
            <p class="lead">Podemos enviártelo de nuevo</p>
          </div>

          <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

          <div class="card">
            <div class="card-header bg-light">
              <div class="text-center">
                <img src="/build/img/logo.png" alt="Logo La 57 Cap" width="200" height="200" style="border-radius: 50%;">
              </div>
            </div>

            <div class="card-body">
              <div class="m-sm-3">
                <form method="POST">
                  <div class="mb-3">
                    <label class="form-label">Correo electrónico</label>
                    <input type="email" name="email"  maxlength="30" class="form-control form-control-lg" placeholder="Ejemplo: micorreo@email.com" required>
                  </div>
                  <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn btn-primary" value="Reenviar Confirmación">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="text-center mt-3">
            ¿Ya tienes cuenta? <a href="/login">Inicia Sesión</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
