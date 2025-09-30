<body>
    <div class="container">
        <h2>➕ Crear Nuevo Token</h2>

        <form method="POST">
            <label>Cliente:</label>
            <select name="id_client_api" required>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['razon_social']) ?></option>
                <?php endforeach; ?>
            </select>

            <label>Token:</label>
            <input type="text" name="token" required>

            <label>Estado:</label>
            <select name="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>

            <button type="submit" class="btn-primary">💾 Guardar</button>
            <a href="index.php?route=apitoken:index" class="btn-secondary">⬅ Cancelar</a>
        </form>
    </div>
</body>
