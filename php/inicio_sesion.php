<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión / Registrarse</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div id="login-register-container">
        <h2 id="login-title">Iniciar sesión</h2>
        <form id="login-form" action="login.php" method="post">
            <label class="label-form" for="email">Correo electrónico:</label>
            <input class="input-form" type="email" id="email" name="email" required>
            <label class="label-form" for="password">Contraseña:</label>
            <input class="input-form" type="password" id="password" name="password" required>
            <input class="btn-form" type="submit" value="Iniciar sesión">
        </form>

        <h2 id="register-title">Registrarse</h2>
        <form id="register-form" action="register.php" method="post">
            <label class="label-form" for="nombre">Nombre:</label>
            <input class="input-form" type="text" id="nombre" name="nombre" required>
            <label class="label-form" for="apellido">Apellido:</label>
            <input class="input-form" type="text" id="apellido" name="apellido" required>
            <label class="label-form" for="email_reg">Correo electrónico:</label>
            <input class="input-form" type="email" id="email_reg" name="email_reg" required>
            <label class="label-form" for="telefono">Teléfono:</label>
            <input class="input-form" type="tel" id="telefono" name="telefono" required>
            <label class="label-form" for="direccion">Dirección:</label>
            <textarea class="input-form" id="direccion" name="direccion" required></textarea>
            <label class="label-form" for="password_reg">Contraseña:</label>
            <input class="input-form" type="password" id="password_reg" name="password_reg" required>
            <input class="btn-form" type="submit" value="Crear usuario">
        </form>
    </div>
</body>
</html>
