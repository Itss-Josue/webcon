<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - WEBcon</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<div class="container">
  <div class="row justify-content-center" style="margin-top:80px">
    <div class="col-12 col-md-5">
      <div class="card shadow">
        <div class="card-body">
          <h4 class="card-title mb-4 text-center">Iniciar sesión</h4>
          <?php if(!empty($_SESSION['flash_error'])){ echo '<div class="alert alert-danger">'.$_SESSION['flash_error'].'</div>'; unset($_SESSION['flash_error']); } ?>
          <form method="post" action="index.php?route=Auth:doLogin">
            <div class="mb-3"><label class="form-label">Usuario</label><input name="username" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Contraseña</label><input name="password" type="password" class="form-control" required></div>
            <div class="d-grid"><button class="btn btn-primary">Entrar</button></div>
          </form>
          <div class="mt-3 text-muted small">Usuario demo: <b>admin</b> — usa la contraseña correspondiente en tu BD.</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body></html>
