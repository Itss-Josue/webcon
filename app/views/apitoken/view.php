<body>
    <div class="container">
        <h2>👁 Detalle del Token</h2>

        <p><b>ID:</b> <?= htmlspecialchars($token['id']) ?></p>
        <p><b>Cliente:</b> <?= htmlspecialchars($token['razon_social']) ?></p>
        <p><b>Token:</b> <?= htmlspecialchars($token['token']) ?></p>
        <p><b>Fecha Registro:</b> <?= htmlspecialchars($token['fecha_registro']) ?></p>
        <p><b>Estado:</b> <?= $token['estado'] ? '✅ Activo' : '❌ Inactivo' ?></p>

        <a href="index.php?route=apitoken:index" class="btn-secondary">⬅ Volver</a>
    </div>
</body>
