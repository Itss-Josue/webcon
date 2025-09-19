<h2>Detalle Cliente API</h2>
<p><b>ID:</b> <?= $cliente['id'] ?></p>
<p><b>RUC:</b> <?= $cliente['ruc'] ?></p>
<p><b>Razón Social:</b> <?= $cliente['razon_social'] ?></p>
<p><b>Teléfono:</b> <?= $cliente['telefono'] ?></p>
<p><b>Correo:</b> <?= $cliente['correo'] ?></p>
<p><b>Fecha Registro:</b> <?= $cliente['fecha_registro'] ?></p>
<p><b>Estado:</b> <?= $cliente['estado'] ? 'Activo' : 'Inactivo' ?></p>
<a href="index.php?controller=ClientApi&action=index">⬅ Volver</a>
