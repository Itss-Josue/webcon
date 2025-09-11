<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - WebCon</title>
    <link rel="stylesheet" href="/webcon/public/css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>

        <?php if(isset($error)): ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="/webcon/auth/doLogin">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Ingresar</button>
        </form>
    </div>
</body>
</html>
