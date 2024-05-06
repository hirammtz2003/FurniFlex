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
             // Redirigir al usuario a otra página
            header("Location: catalogo.html");
            exit(); // Asegurarse de que el script no continúe después de la redirección
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
    <div class="container">
    <h2>Registro de Usuarios</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="input-group">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
        </div>
        <div class="input-group">
            <input type="text" id="paterno" name="paterno" placeholder="Apellido Paterno" required>
        </div>
        <div class="input-group">
            <input type="text" id="materno" name="materno" placeholder="Apellido Materno" required>
        </div>
        <div class="input-group">
            <input type="text" id="domicilio" name="domicilio" placeholder="Domicilio" required>
        </div>
        <div class="input-group">
            <input type="tel" id="telefono" name="telefono" placeholder="Número Teléfono" required>
        </div>
        <div class="input-group">
            <input type="email" id="email" name="email" placeholder="Email"required>
        </div>
        <div class="input-group">
            <input type="text" id="nombreUsuario" name="nombreUsuario" placeholder="Nombre de Usuario" required>
        </div>
        <div class="input-group">
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
        </div>
        <div class="input-group">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Contraseña"required>
        </div>
        <input type="submit" value="Registrarse">
    </form>
</div>
</body>
</html>
