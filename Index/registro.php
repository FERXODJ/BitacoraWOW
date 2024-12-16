<?php
// Conectar a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor no es localhost
$username_db = "root"; // Cambia esto por tu usuario de MySQL
$password_db = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "iniciosesiondb"; // Cambia esto por el nombre de tu base de datos

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Inicializa la variable de mensaje de error
$message = '';

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];
    $nombre_completo = $_POST['nombre_completo'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Verifica que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $message = "<p style='color: red;'>Las contraseñas no coinciden.</p>";
    } else {
        // Preparar la consulta para insertar datos (sin hashear la contraseña)
        $stmt = $conn->prepare("INSERT INTO usuarios (Usuario, Clave, Nombre_Completo, Email, Telefono) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $nombre_completo, $email, $telefono);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Registro exitoso.</p>";
        } else {
            $message = "<p style='color: red;'>Error al registrar: " . $stmt->error . "</p>";
        }

        // Cerrar la declaración
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Registrarse</title>
</head>
<body>

<div class="container">
    <div class="login-form">
        <h2>Registrarse</h2>

        <!-- Mover el mensaje aquí, antes del formulario -->
        <?= $message; ?>

        <form id="registerForm" action="#" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmar Contraseña:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            <div class="form-group"> 
                <label for="nombre_completo">Nombre Completo:</label>
                <input type="text" id="nombre_completo" name="nombre_completo" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono:</label>
                <input type="text" id="telefono" name="telefono" required>
            </div>

            <button type="submit">Registrar</button>
        </form>
        <p class = "count">¿Ya tienes una Cuenta? <a href="index.php">Iniciar Sesion</a></p>
    </div>
</div>

</body>
</html>