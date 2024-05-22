<?php 
include 'conexion.php';
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: inicio_sesion.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Consulta SQL para obtener el artículo según su ID
$sql = "SELECT Nombre,Descripción,Precio_renta,Cantidad_disponible FROM artículo_mobiliario WHERE Id_artículo = 8";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los datos del artículo
    $row = $result->fetch_assoc();
    $articulo = $row["Nombre"];
    $descripcion = $row["Descripción"];
    $precio = "$ ". $row["Precio_renta"];
    $cantiDisp = $row["Cantidad_disponible"]." disponibles";

} else {
    echo "No se encontraron resultados para el ID proporcionado";
}

// Consulta SQL para obtener el artículo según su ID
$sql1 = "SELECT Nombre,Descripción,Precio_renta,Cantidad_disponible FROM artículo_mobiliario WHERE Id_artículo = 7";

$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    // Mostrar los datos del artículo
    $row1 = $result1->fetch_assoc();
    $articulo1 = $row1["Nombre"];
    $descripcion1 = $row1["Descripción"];
    $precio1 = "$ ". $row1["Precio_renta"];
    $cantiDisp1 = $row1["Cantidad_disponible"]." disponibles";

} else {
    echo "No se encontraron resultados para el ID proporcionado";
}

// Consulta SQL para obtener el artículo según su ID
$sql2 = "SELECT Nombre,Descripción,Precio_renta,Cantidad_disponible FROM artículo_mobiliario WHERE Id_artículo = 6";

$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    // Mostrar los datos del artículo
    $row2 = $result2->fetch_assoc();
    $articulo2 = $row2["Nombre"];
    $descripcion2 = $row2["Descripción"];
    $precio2 = "$ ". $row2["Precio_renta"];
    $cantiDisp2 = $row2["Cantidad_disponible"]." disponibles";

} else {
    echo "No se encontraron resultados para el ID proporcionado";
}

// Consulta SQL para obtener el artículo según su ID
$sql3 = "SELECT Nombre,Descripción,Precio_renta,Cantidad_disponible FROM artículo_mobiliario WHERE Id_artículo = 5";

$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    // Mostrar los datos del artículo
    $row3 = $result3->fetch_assoc();
    $articulo3 = $row3["Nombre"];
    $descripcion3 = $row3["Descripción"];
    $precio3 = "$ ". $row3["Precio_renta"];
    $cantiDisp3 = $row3["Cantidad_disponible"]." disponibles";

} else {
    echo "No se encontraron resultados para el ID proporcionado";
}

// Cerrar conexión
$conn->close();




?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FurniFlex | Catálogo | Sillas</title>
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
            height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            padding-bottom: 20px;
        }
        .azul-claro {
            background-color: #C9DAF8;
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
        .panel-input {
            width: 45%; /* Ancho del input */
            margin-bottom: 10px; /* Espaciado inferior */
            padding: 5px; /* Espaciado interno */
            border: 1px solid #ccc; /* Borde */
            border-radius: 5px; /* Borde redondeado */
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
    <div class="panel azul-claro" data-id="8">
        <img src="Silla 1.jpeg" alt="Silla 1">
        <div class="panel-text">
            <div class="panel-title"><?php echo $articulo; ?></div>
            <div class="panel-description"><?php echo $descripcion; ?></div>
            <div class="panel-price"><?php echo $precio; ?></div>
            <div class="panel-availability"><?php echo $cantiDisp; ?></div>
            <input type="number" class="panel-input" placeholder="Ingresar cantidad">
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel azul-claro" data-id="7">
        <img src="Silla 2.jpeg" alt="Silla 2">
        <div class="panel-text">
            <div class="panel-title"><?php echo $articulo1; ?></div>
            <div class="panel-description"><?php echo $descripcion1; ?></div>
            <div class="panel-price"><?php echo $precio1; ?></div>
            <div class="panel-availability"><?php echo $cantiDisp1; ?></div>
            <input type="number" class="panel-input" placeholder="Ingresar cantidad">
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel azul-claro" data-id="6">
        <img src="Silla 3.jpeg" alt="Silla 3">
        <div class="panel-text">
            <div class="panel-title"><?php echo $articulo2; ?></div>
            <div class="panel-description"><?php echo $descripcion2; ?></div>
            <div class="panel-price"><?php echo $precio2; ?></div>
            <div class="panel-availability"><?php echo $cantiDisp2; ?></div>
            <input type="number" class="panel-input" placeholder="Ingresar cantidad">
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
    <div class="panel azul-claro" data-id="5">
        <img src="Silla 4.jpeg" alt="Silla 4">
        <div class="panel-text">
            <div class="panel-title"><?php echo $articulo3; ?></div>
            <div class="panel-description"><?php echo $descripcion3; ?></div>
            <div class="panel-price"><?php echo $precio3; ?></div>
            <div class="panel-availability"><?php echo $cantiDisp3; ?></div>
            <input type="number" class="panel-input" placeholder="Ingresar cantidad">
            <button class="add-to-cart-button">Añadir a carrito</button>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // Evento de clic para el botón "Añadir a carrito"
    $('.add-to-cart-button').click(function() {
        // Obtener el panel del artículo asociado al botón
        var panel = $(this).closest('.panel');

        // Recopilar la información del artículo
        var nombre = panel.find('.panel-title').text();
        var precio = panel.find('.panel-price').text().replace('$', '').trim();
        var cantidad = panel.find('.panel-input').val();
        // Obtener el id_artículo del contenedor del panel
        var id_articulo = panel.data('id');

        // Objeto con los datos a enviar al servidor
        var data = {
            id_articulo: id_articulo,
            nombre: nombre,
            precio: precio,
            cantidad: cantidad
        };

        // Enviar una solicitud AJAX para insertar los datos en la tabla item_articulo
        $.ajax({
            url: 'insertar_item.php', // URL del script PHP que maneja la inserción
            type: 'POST',
            data: data,
            success: function(response) {
                // Manejar la respuesta del servidor
                if (response === 'success') {
                    alert('El artículo se ha añadido al carrito correctamente.');
                    // Borrar el número ingresado en el input
                    panel.find('.panel-input').val('');
                } else {
                    alert('Error al añadir el artículo al carrito. Inténtalo de nuevo más tarde.');
                }
            },
            error: function() {
                alert('Error al procesar la solicitud. Inténtalo de nuevo más tarde.');
            }
        });
    });
</script>

</body>
<footer></footer>
</html>