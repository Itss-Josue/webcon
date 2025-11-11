<?php
if(!isset($_SESSION)) session_start();
?>
<!doctype html><html lang="es"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>WEBcon</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>body{padding-top:70px}</style>
</head><body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?route=Dashboard:index">WEBcon</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navMenu"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><form method="post" action="index.php?route=Client:index" class="d-inline"><button class="nav-link btn btn-link">Clientes</button></form></li>
        <li class="nav-item"><form method="post" action="index.php?route=Project:index" class="d-inline"><button class="nav-link btn btn-link">Proyectos</button></form></li>
        <li class="nav-item"><form method="post" action="index.php?route=Payment:index" class="d-inline"><button class="nav-link btn btn-link">Pagos</button></form></li>
        <li class="nav-item"><form method="post" action="index.php?route=ClientApi:index" class="d-inline"><button class="nav-link btn btn-link">APIs</button></form></li>
        <li class="nav-item"><form method="post" action="index.php?route=Token:index" class="d-inline"><button class="nav-link btn btn-link">Tokens</button></form></li>
      </ul>
      <div class="d-flex">
        <span class="navbar-text text-white me-3">Hola, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Invitado') ?></span>
        <form method="post" action="index.php?route=Auth:logout"><button class="btn btn-outline-light">Salir</button></form>
      </div>
    </div>
  </div>
</nav>
<div class="container">

<?php if (!isset($_SESSION['bienvenida_mostrada'])): ?>
<script>
Swal.fire({
  title: "¡Bienvenido <?= htmlspecialchars($_SESSION['user_name'] ?? 'Invitado') ?>!",
  text: "Has ingresado correctamente al sistema WEBcon",
  icon: "success",
  confirmButtonText: "Continuar",
  draggable: true
});
</script>
<?php $_SESSION['bienvenida_mostrada'] = true; endif; ?>
