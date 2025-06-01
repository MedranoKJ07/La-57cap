<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">Reestablecer Contraseña</h1>
            <p class="lead">Colocá tu nueva contraseña a continuación</p>
          </div>

          <div class="card">
            <div class="card-header text-center">
              <img src="/build/img/logo.png" alt="Logo" width="120" height="120" style="border-radius: 50%;">
            </div>

            <div class="card-body">
              <?php include_once __DIR__ . "/../templates/alertas.php"; ?>

              <?php if($error) return; ?>

              <form method="POST">
                <div class="mb-3">
                  <label for="password" class="form-label">Ingrese una nueva Contraseña</label>
                  <input type="password"  maxlength="30" id="password" name="password" class="form-control form-control-lg" placeholder="Tu nuevo password" required>
                </div>

                <div class="d-grid gap-2 mt-4">
                  <input type="submit" class="btn btn-success btn-lg" value="Guardar Contraseña">
                </div>
              </form>
            </div>

            <div class="text-center mb-3">
              ¿Ya tenés cuenta? <a href="/">Iniciar sesión</a>
            </div>
            <div class="text-center mb-3">
              ¿No tenés cuenta? <a href="/crear-cuenta">Registrate</a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
