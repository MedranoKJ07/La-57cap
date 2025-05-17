<main class="d-flex w-100"> 
  <div class="container d-flex flex-column">
    <div class="row vh-100">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

          <div class="text-center mt-4">
            <h1 class="h2">Crear Cuenta</h1>
            <p class="lead">Regístrate para comenzar</p>
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
                <form method="POST">
                  <h5 class="mb-3">Datos del Usuario</h5>
                  <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input class="form-control" type="text" name="usuario[userName]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input class="form-control" type="email" name="usuario[email]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input class="form-control" type="password" name="usuario[password]" required>
                  </div>

                  <hr>

                  <h5 class="mb-3">Datos del Cliente</h5>
                  <div class="mb-3">
                    <label class="form-label">Primer Nombre</label>
                    <input class="form-control" type="text" name="cliente[p_nombre]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Segundo Nombre</label>
                    <input class="form-control" type="text" name="cliente[s_nombre]">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Primer Apellido</label>
                    <input class="form-control" type="text" name="cliente[p_apellido]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Segundo Apellido</label>
                    <input class="form-control" type="text" name="cliente[s_apellido]">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Número de Teléfono</label>
                    <input class="form-control" type="text" name="cliente[n_telefono]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Dirección</label>
                    <input class="form-control" type="text" name="cliente[direccion]" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Municipio</label>
                    <input class="form-control" type="text" name="cliente[Municipio]" required>
                  </div>

                  <div class="d-grid gap-2 mt-3">
                    <input type="submit" class="btn btn-primary" value="Registrarse">
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
