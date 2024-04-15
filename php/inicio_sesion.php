<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión / Registrarse</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <form action="login.php" method="post">
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Iniciar sesión">
        </form>

        <h2>Registrarse</h2>
        <form action="register.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>
            <label for="email_reg">Correo electrónico:</label>
            <input type="email" id="email_reg" name="email_reg" required>
            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>
            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="direccion" required></textarea>
            <label for="password_reg">Contraseña:</label>
            <input type="password" id="password_reg" name="password_reg" required>
            <input type="submit" value="Crear usuario">
        </form>
    </div>
</body>
</html>
