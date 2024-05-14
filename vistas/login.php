  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card shadow card-custom">

          <div class="card-body">

            <div class="text-center mb-4">
              <img src="./img/logo_fondo_blanco.jpg" alt="Logo" style="width: 100px;">
              <h4 class="mt-3">Inicia Sesión</h4>
            </div>

            <form class="box login" action="" method="POST" autocomplete="off">
              <div class="mb-4">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" name="login_usuario" class="form-control" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Entrar</button>
              </div>
              <?php
                // Si las variables login_usuario y login_clave traen texto en ellas o estan definidas entonces:
                if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
                  // Incluimos el archivo main.php y iniciar_sesion.php
                  require_once "./php/main.php";
                  require_once "./php/iniciar_sesion.php";
                }
              ?>
            </form>

          </div>

        </div>
      </div>
    </div>
  </div>