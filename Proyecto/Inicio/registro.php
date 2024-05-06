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
    <title>FurniFlex | Registro de usuario</title>
    <style>
        header{
            background-color: rgb(81, 163, 240);
            width: 100%;
            height: 100px;
            margin: -8px;
            border: solid 2px;
        }
        body{background-color: rgb(255, 255, 255);
            width: 100%;
            height: 100%;
        }
        #butIniSec{
            height: 50px;
            width: 150px;
            position: relative;
            top: 23px;
            left: 1000px;
            font-family: sans-serif;
            font-size: 16px;
            font-weight: bold;

        }
        #logoH{ 
            position: relative;
            top: 30px;
            left: 30px;
        }
        #textContainer{
            border: solid 3px rgb(233, 170, 22);
            height: 200px;
            width: 530px;
            position: relative;
            bottom: 300px;
            left: 80px;
            margin: 2px;
            padding: 5px;
        }
        p{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        #fContainer{
            background-color: rgb(249, 183, 216);
            border:solid 2px rgb(18, 70, 118);
            height: 30px;
            width: 900px;
            position: relative;
            left: 30px;
            bottom: 130px;
        }
        /* Estilos para el enlace del logotipo */
        #logoLink {
            text-decoration: none; /* Eliminar subrayado */
            display: inline-block; /* Hacer que el enlace respete las dimensiones del logotipo */
            background-color: transparent; /* Fondo transparente */
            border: none; /* Sin borde */
            cursor: pointer; /* Cursor de apuntador */
        }
        /* Estilos para el enlace de registro */
        #registroLink {
            text-decoration: none; /* Eliminar subrayado */
            display: block; /* Hacer que el enlace ocupe todo el ancho disponible */
            text-align: center; /* Centrar el texto */
            margin-top: 20px; /* Margen superior */
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Fuente */
            color: blue; /* Color del texto */
        }
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        .input-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <a href="index.html" id="logoLink">
        <img src="logo.png" id="logoH" />
    </a>
    <button onclick="gotoIniciarSesion()" name="botonInicioSesion" id="butIniSec">Iniciar Sesión</button>

</header>

    <h2>Registro de Usuarios</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
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

<script>
    function gotoIniciarSesion() {
        window.location.href = "inicio_sesion.html";
    }
</script>

</body>
<footer></footer>
</html>