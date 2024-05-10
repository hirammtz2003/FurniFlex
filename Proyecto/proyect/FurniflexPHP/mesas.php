<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consulta SQL para obtener la información de los artículos
$sql = "SELECT * FROM artículo_mobiliario WHERE id_artículo IN (1, 2, 3, 4)";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FurniFlex | Catálogo | Mesas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
    </style>
</head>
<body>
<header>
    <a href="index.html" id="logoLink">
        <img src="logo.png" id="logoH" />
    </a>
</header>

<div id="catalogo">
    <?php
    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Iterar sobre los resultados y mostrarlos en los paneles
        while ($row = $result->fetch_assoc()) {
            // Generar la ruta de la imagen basada en el ID del artículo
            $imagen = "Mesa " . $row['id_artículo'] . ".jpeg";
            ?>
            <div class="panel rosa-claro" data-id="<?php echo $row['id_artículo']; ?>">
                <!-- Muestra la imagen del artículo -->
                <img src="<?php echo $imagen; ?>" alt="Mesa <?php echo $row['id_artículo']; ?>">
                <!-- Aquí muestras la información de cada artículo -->
                <div class="panel-text">
                    <div class="panel-title"><?php echo $row['Nombre']; ?></div>
                    <div class="panel-description"><?php echo $row['Descripción']; ?></div>
                    <div class="panel-price">$ <?php echo $row['Precio_renta']; ?></div>
                    <div class="panel-availability"><?php echo $row['Cantidad_disponible']; ?> disponibles</div>
                    <input type="number" class="panel-input" placeholder="Ingresar cantidad">
                    <button class="add-to-cart-button">Añadir a carrito</button>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No se encontraron artículos.";
    }
    ?>
</div>

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