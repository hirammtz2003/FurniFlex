<?php
// Inicializar variables de sesión

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';



// Definir variables para los mensajes de error
$mensaje_usuario = $mensaje_contraseña = "";

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $campo = $_POST['campo'];
    $contraseña = $_POST['contraseña'];

    // Consulta para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuario WHERE Nombre_Usuario ='$campo' OR Email='$campo'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row['Contraseña'];

        // Verificar si la contraseña coincide
        if ($contraseña==$stored_password) {
            // Las credenciales son válidas, establecer una variable de sesión
            
            $_SESSION['usuario'] = $row['Nombre_Usuario'];
            $_SESSION['id_usuario'] = $row['id_usuario'];

            // Redirigir al usuario a la página de inicio después de iniciar sesión exitosamente
            header("Location: catalogo.php");
            exit(); // Asegurar que el script no continúe después de la redirección
        } else {
            $mensaje_contraseña = "Contraseña incorrecta.";
        }
    } else {
        $mensaje_usuario = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furni Flex - Iniciar Sesión</title>
    <style>
        body {
            background-color: #87CEEB; 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: left;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Furni Flex - Iniciar sesión</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" placeholder="Usuario o E-mail" name="campo" required><br>
            <span class="error-message"><?php echo $mensaje_usuario; ?></span>
            <input type="password" placeholder="Contraseña" name="contraseña" required><br>
            <span class="error-message"><?php echo $mensaje_contraseña; ?></span>
            <input type="submit" value="Iniciar sesión">
        </form>
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</body>
</html>
