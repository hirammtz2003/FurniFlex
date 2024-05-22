<?php 
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FurniFlex | Catálogo</title>
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
        #catalogo {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .panel {
            width: 300px;
            height: 380px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .panel:hover {
            transform: scale(1.05);
        }

        .rosa-claro {
            background-color: #F4CCCC;
        }

        .azul-claro {
            background-color: #C9DAF8;
        }

        .amarillo-claro {
            background-color: #FFF2CC;
        }

        .naranja-claro {
            background-color: #FFE599;
        }

        .panel img {
            width: 280px;
            height: auto;
            margin-bottom: 10px;
        }

        .panel p {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            font-weight: bold;
        }

        .add-to-cart-button {
            font-size: 16px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 40px; /* Ajusta la posición vertical según sea necesario */
            left: 50%; /* Centra horizontalmente */
            transform: translateX(-50%);
            text-decoration: none;
        }

        .add-to-cart-button:hover {
            background-color: #45a049;
        }
        #user{
            height: 50px;
            width: 150px;
            position: relative;
            top: -24px;
            left: 1085px;
            font-family: sans-serif;
            font-size: 16px;
            font-weight: bold;
            color: purple;
        }
        #userH{
            height: 50px;
            width: 50px;
            position: relative;
            top: 23px;
            left: 900px;
            
        }
        
    </style>
</head>
<body>
<header>
    <a href="index.html" id="logoLink">
        <img src="logo.png" id="logoH" />
    </a>

    <img src="user.png" id="userH" />
    <h3 id="user"><?php echo $usuario; ?></h3>
</header>

<div id="catalogo">
    <a href="mesas.php" class="panel rosa-claro">
        <img src="Mesa portada.jpg">
        <p>Mesas</p>
    </a>
    <a href="sillas.php" class="panel azul-claro">
        <img src="Silla portada.jpg">
        <p>Sillas</p>
    </a>
    <a href="carpas.php" class="panel amarillo-claro">
        <img src="Carpa portada.jpg">
        <p>Carpas</p>
    </a>
    <a href="inflables.php" class="panel naranja-claro">
        <img src="Inflable portada.jpg">
        <p>Inflables</p>
    </a>
</div>

<a href="carrito.php" class="add-to-cart-button">Ver carrito</a>

</body>
<footer></footer>
</html>