<?php
include 'conexion.php';

// Inicializar variables de error
$errors = array();

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $domicilio = $_POST['domicilio'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Verificar que las contraseñas coincidan
    if ($password !== $confirm_password) {
        $errors[] = "Las contraseñas no coinciden.";
    }

    // Verificar si hay errores
    if (empty($errors)) {
        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar datos en la base de datos
        $sql = "INSERT INTO usuario (Nombre, Ap_paterno, Ap_materno, Domicilio, Num_tel, Email, Nombre_Usuario, Contraseña) VALUES ('$nombre', '$paterno', '$materno', '$domicilio', '$telefono', '$email', '$nombreUsuario', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}

// Cerrar conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registro de Usuarios</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="input-group">
            <label for="paterno">Apellido Paterno:</label>
            <input type="text" id="paterno" name="paterno" required>
        </div>
        <div class="input-group">
            <label for="materno">Apellido Materno:</label>
            <input type="text" id="materno" name="materno" required>
        </div>
        <div class="input-group">
            <label for="domicilio">Domicilio:</label>
            <input type="text" id="domicilio" name="domicilio" required>
        </div>
        <div class="input-group">
            <label for="telefono">Número Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="nombreUsuario">Nombre de Usuario:</label>
            <input type="text" id="nombreUsuario" name="nombreUsuario" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
            <label for="confirm_password">Confirmar Contraseña:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
