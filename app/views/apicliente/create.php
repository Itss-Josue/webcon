<h2>Agregar Cliente API</h2>
<form method="POST">
    <label>RUC:</label><input type="text" name="ruc" required><br>
    <label>Razón Social:</label><input type="text" name="razon_social" required><br>
    <label>Teléfono:</label><input type="text" name="telefono"><br>
    <label>Correo:</label><input type="email" name="correo"><br>
    <label>Fecha Registro:</label><input type="date" name="fecha_registro" required><br>
    <label>Estado:</label>
    <select name="estado">
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select><br>
    <button type="submit">Guardar</button>
</form>
<a href="index.php?controller=ClientApi&action=index">⬅ Volver</a>
