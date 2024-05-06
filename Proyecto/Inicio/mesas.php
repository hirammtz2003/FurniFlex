<?php
include 'conexion.php';

// Consulta para obtener los datos de los artículos
$sql = "SELECT Nombre, Descripción, Precio_renta, Cantidad_disponible FROM artículo_mobiliario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while($row = $result->fetch_assoc()) {
        echo "Nombre: " . $row["Nombre"]. " - Descripción: " . $row["Descripción"]. " - Precio: " . $row["Precio_renta"]. " - Disponibilidad: " . $row["Cantidad_disponible"]. "<br>";
    }
} else {
    echo "0 resultados";
}
$conn->close();
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
            height: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .rosa-claro {
            background-color: #F4CCCC;
        }

        .panel img {
            width: 280px;
            height: auto;
            margin-bottom: 10px;
        }

        .panel-text {
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .panel-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .panel-description {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .panel-price {
            font-size: 20px;
            color: green;
            margin-bottom: 5px;
        }

        .panel-availability {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .add-to-cart-button {
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header>
    <a href="index.html" id="logoLink">
        <img src="logo.png" id="logoH" />
    </a>
</header>

<div id="catalogo">
    <div class="panel rosa-claro">
        <img src="" alt="">
        <div class="panel-text">
            <div class="panel-title"></div>
            <div class="panel-description"></div>
            <div class="panel-price"></div>
            <div class="panel-availability"></div>
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel rosa-claro">
        <img src="mesas.jpg" alt="Sillas">
        <div class="panel-text">
            <div class="panel-title">Sillas</div>
            <div class="panel-description">Descripción de las sillas disponibles.</div>
            <div class="panel-price">$ 50.00</div>
            <div class="panel-availability">10 disponibles</div>
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel rosa-claro">
        <img src="mesas.jpg" alt="Carpas">
        <div class="panel-text">
            <div class="panel-title">Carpas</div>
            <div class="panel-description">Descripción de las carpas disponibles.</div>
            <div class="panel-price">$ 200.00</div>
            <div class="panel-availability">3 disponibles</div>
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel rosa-claro">
        <img src="mesas.jpg" alt="Inflables">
        <div class="panel-text">
            <div class="panel-title">Inflables</div>
            <div class="panel-description">Descripción de los inflables disponibles.</div>
            <div class="panel-price">$ 150.00</div>
            <div class="panel-availability">7 disponibles</div>
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
</div>

</body>
<footer></footer>
</html>