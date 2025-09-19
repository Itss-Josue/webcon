<h2>Editar Cliente API</h2>
<form method="POST">
    <label>RUC:</label><input type="text" name="ruc" value="<?= $cliente['ruc'] ?>" required><br>
    <label>Razón Social:</label><input type="text" name="razon_social" value="<?= $cliente['razon_social'] ?>" required><br>
    <label>Teléfono:</label><input type="text" name="telefono" value="<?= $cliente['telefono'] ?>"><br>
    <label>Correo:</label><input type="email" name="correo" value="<?= $cliente['correo'] ?>"><br>
    <label>Fecha Registro:</label><input type="date" name="fecha_registro" value="<?= $cliente['fecha_registro'] ?>" required><br>
    <label>Estado:</label>
    <select name="estado">
        <option value="1" <?= $cliente['estado'] ? 'selected' : '' ?>>Activo</option>
        <option value="0" <?= !$cliente['estado'] ? 'selected' : '' ?>>Inactivo</option>
    </select><br>
    <button type="submit">Actualizar</button>
</form>
<a href="index.php?controller=ClientApi&action=index">⬅ Volver</a>
