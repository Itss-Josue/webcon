<?php $editing = isset($user) && $user; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> Usuario</h4>
<form method="post" action="index.php?route=User:<?= $editing ? 'update' : 'store' ?>">
  <?php if($editing): ?><input type="hidden" name="id" value="<?= $user['id'] ?>"><?php endif; ?>
  <div class="mb-3"><label>Usuario</label><input name="username" class="form-control" required value="<?= $editing ? htmlspecialchars($user['username']) : '' ?>"></div>
  <div class="mb-3"><label>Contraseña <?= $editing ? '(dejar vacío para no cambiar)' : '' ?></label><input name="password" type="password" class="form-control" <?= $editing ? '' : 'required' ?>></div>
  <div class="mb-3"><label>Nombre</label><input name="name" class="form-control" value="<?= $editing ? htmlspecialchars($user['name']) : '' ?>"></div>
  <div class="mb-3"><label>Rol</label><select name="role" class="form-select"><option value="admin" <?= $editing && $user['role']=='admin' ? 'selected':'' ?>>admin</option><option value="user" <?= $editing && $user['role']=='user' ? 'selected':'' ?>>user</option></select></div>
  <div><button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button> <a class="btn btn-secondary" href="index.php?route=User:index">Cancelar</a></div>
</form>
