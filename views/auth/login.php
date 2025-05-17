<main class="d-flex w-100">
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">¡Bienvenido de nuevo!</h1>
            <p class="lead">Inicia sesión para continuar</p>
          </div>

          <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

          <div class="card">
            <div class="card-header bg-light">
              <div class="text-center">
                <img src="/build/img/logo.png" alt="Perfil" width="200" height="200" style="border-radius: 50%;">
              </div>
            </div>

            <div class="card-body">
              <div class="m-sm-3">
                <form method="POST" >
                  <div class="mb-3">
                    <label class="form-label">Correo o Nombre de Usuario</label>
                    <input class="form-control form-control-lg" type="text" name="usuario[email]"
                      placeholder="Escribe tu correo o usuario"
                      value="<?php echo s($usuario->email); ?>">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input class="form-control form-control-lg" type="password" name="usuario[password]"
                      placeholder="Escribe tu contraseña">
                  </div>

                  <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn btn-lg btn-primary" value="Iniciar Sesión">
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="text-center mt-3">
            ¿No tienes cuenta? <a href="/crear-cuenta">Regístrate</a>
          </div>
          <div class="text-center mb-3">
            ¿Olvidaste tu contraseña? <a href="/olvide-cuenta">Recuperar</a>
          </div>

        </div>
      </div>
    </div>
  </div>
</main>
