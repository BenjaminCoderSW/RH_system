<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-custom {
      margin-top: 50px;
      margin-bottom: 50px;
    }
  </style>
</head>
<!-- cambios de benji -->
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <div class="card shadow card-custom">
          <div class="card-body">
            <div class="text-center mb-4">
              <img src="./img/aF0HKEKj_400x400.jpg" alt="Logo" style="width: 100px;">
              <h4 class="mt-3">Inicia Sesión</h4>
            </div>
            <form id="loginForm">
              <div class="mb-4">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" class="form-control" id="username" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" required>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Entrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function (e) {
      e.preventDefault(); // Previene el comportamiento por defecto del formulario
      // Aquí puedes agregar validaciones o consultas a una API para la autenticación
      window.location.href = 'list_employees.php'; // Redirecciona a la página de empleados
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>