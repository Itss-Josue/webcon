<body>
    <div class="container">
        <h2>✏ Editar Token</h2>

        <form method="POST">
            <label>Cliente:</label>
            <select name="id_client_api" required>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $c['id'] == $token['id_client_api'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['razon_social']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Token:</label>
            <input type="text" name="token" value="<?= htmlspecialchars($token['token']) ?>" required>

            <label>Estado:</label>
            <select name="estado">
                <option value="1" <?= $token['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                <option value="0" <?= $token['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
            </select>

            <button type="submit" class="btn-primary">💾 Guardar Cambios</button>
            <a href="index.php?route=apitoken:index" class="btn-secondary">⬅ Cancelar</a>
        </form>
    </div>
</body>
