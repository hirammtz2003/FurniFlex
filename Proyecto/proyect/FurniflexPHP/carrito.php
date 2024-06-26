<?php 
 // Incluir el archivo de conexión a la base de datos
 include 'conexion.php';

 // Verificar si el usuario ha iniciado sesión
 if (!isset($_SESSION['usuario'])) {
     header("Location: inicio_sesion.php");
     exit();
 }
 
 $id_usuario = $_SESSION['id_usuario'];
 $usuario = $_SESSION['usuario'];


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FurniFlex | Carrito</title>
    <style>
        header {
            background-color: rgb(81, 163, 240);
            width: 100%;
            height: 100px;
            margin: -8px;
            border: solid 2px;
        }
        body {
            background-color: rgb(255, 255, 255);
            width: 100%;
            height: 100%;
        }
        #logoH { 
            position: relative;
            top: 30px;
            left: 30px;
        }
        #tabla {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .panel img {
            width: 280px;
            height: auto;
            margin-bottom: 10px;
        }
        .panel {
            width: 800px; /* Ancho del panel */
            height: auto;
            display: flex;
            flex-direction: column;
            align-self: flex-start; /* Cambiado de center a flex-start */
            justify-content: center;
            border-radius: 10px;
            background-color: #C9FFBF; /* Cambiado a verde claro */
            padding: 20px; /* Añade espacio alrededor de la tabla */
            margin-left: -500px; /* Añade un margen izquierdo para cargar el panel hacia la izquierda */
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Aplica la tipografía al panel */
            bottom: 30px;
            margin-bottom: 30px; 
        }
        .panel table {
            width: calc(100% - 40px); /* Ancho de la tabla ajustado al panel */
            border-collapse: collapse;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: white;
        }
        .panel th,
        .panel td {
            border: 1px solid black;
            padding: 5px;
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Aplica la tipografía a las celdas */
        }
        .panel th {
            font-weight: bold; /* Hace que el texto en las celdas de encabezado esté en negrita */
        }
        .panel tbody tr:last-child td {
            font-weight: bold; /* Hace que el texto en las celdas de la última fila esté en negrita */
        }
        .panel td:nth-child(3),
        .panel td:nth-child(4),
        .panel td:nth-child(5) {
            text-align: right; /* Alinea el contenido de las celdas de la tercera, cuarta y quinta columna a la derecha */
        }

        .save-cart-button {
            font-size: 16px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: relative;
            bottom: -10px; /* Ajusta la posición vertical según sea necesario */
            left: 30%; /* Centra horizontalmente */
            transform: translateX(-50%);
            text-decoration: none;
        }

        .save-cart-button:hover {
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

<div id="tabla">
    <div class="panel rosa-claro">
        <table id="tablaProductos">
            <thead>
                <tr>
                    <th style="width: auto; border: 1px solid black;">ID</th>
                    <th style="width: auto; border: 1px solid black;">Nombre</th>
                    <th style="width: auto; border: 1px solid black;">Cantidad</th>
                    <th style="width: auto; border: 1px solid black;">Precio unitario</th>
                    <th style="width: auto; border: 1px solid black;">Precio total</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                // Consulta SQL para obtener los registros de la tabla item_articulo
                $sql = "SELECT id_item, Nombre, Cantidad, Precio, id_usuario FROM item_articulo WHERE id_usuario = $id_usuario" ;
                $result = $conn->query($sql);

                // Verificar si hay resultados
                if ($result->num_rows > 0) {
                    // Iterar sobre los resultados y mostrarlos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_item"] . "</td>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td contenteditable='true' oninput='calcularTotal(this.parentNode);'>" . $row["Cantidad"] . "</td>";
                        echo "<td contenteditable='true' oninput='calcularTotal(this.parentNode);'>" . number_format($row["Precio"], 2) . "</td>";
                        echo "<td></td>"; // La columna para el precio total se llenará dinámicamente con JavaScript
                        echo "</tr>";
                    }
                } else {
                    echo "No se encontraron registros en la tabla item_articulo.";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
                ?>
                <!-- Fila de total -->
                <tr id="filaTotales">
                    <td style="border: 1px solid black;">   —</td>
                    <td style="border: 1px solid black;">TOTAL</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">   —</td>
                    <td style="border: 1px solid black;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<a href="#" class="save-cart-button" onclick="guardarCarrito()">Guardar</a>

<script>
    function guardarCarrito() {
        // Recopilar datos de la tabla
        var tabla = document.getElementById("tablaProductos");
        var filas = tabla.getElementsByTagName("tr");
        var totalUnidades = 0;
        var totalRenta = 0;
        var idItems = [];

        for (var i = 1; i < filas.length - 1; i++) {
            var celdas = filas[i].getElementsByTagName("td");
            var cantidad = parseInt(celdas[2].innerText.replace(/,/g, "")) || 0;
            var precioTotal = parseFloat(celdas[4].innerText.replace("$", "").replace(/,/g, "")) || 0;

            totalUnidades += cantidad;
            totalRenta += precioTotal;

            // Obtener el ID del artículo
            var idItem = parseInt(celdas[0].innerText) || 0;
            if (idItem !== 0) {
                idItems.push(idItem);
            }
        }

        // Enviar los datos al servidor usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Éxito
                    alert("¡Carrito guardado con éxito!");
                    // Puedes redirigir al usuario o realizar otra acción aquí
                } else {
                    // Error
                    alert("Error al guardar el carrito.");
                }
            }
        };

        // Configurar la solicitud POST
        xhr.open("POST", "guardar_carrito.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Construir el cuerpo de la solicitud
        var data = "total_unidades=" + totalUnidades + "&total_renta=" + totalRenta + "&id_items=" + JSON.stringify(idItems);
        xhr.send(data);
    }

    function calcularTotales() {
        var tabla = document.getElementById("tablaProductos");
        var filas = tabla.getElementsByTagName("tr");
        var totalCantidad = 0;
        var totalPrecio = 0;

        // Empezamos desde 1 para omitir la fila de encabezados
        for (var i = 1; i < filas.length - 1; i++) {
            var celdas = filas[i].getElementsByTagName("td");
            var cantidad = parseInt(celdas[2].innerText) || 0;
            var precio = parseFloat(celdas[3].innerText.replace(/,/g, "")) || 0;

            totalCantidad += cantidad;
            totalPrecio += cantidad * precio;

            celdas[4].innerText = numberWithCommas((cantidad * precio).toFixed(2));
        }

        // Actualizar la fila de totales
        var filaTotales = filas[filas.length - 1].getElementsByTagName("td");
        filaTotales[2].innerText = numberWithCommas(totalCantidad) + " unidades";
        filaTotales[4].innerText = "$" + numberWithCommas(totalPrecio.toFixed(2));
    }

    function calcularTotal(fila) {
        var cantidad = parseInt(fila.cells[2].innerText.replace(/,/g, "")) || 0;
        var precio = parseFloat(fila.cells[3].innerText.replace("$", "").replace(/,/g, "")) || 0;

        fila.cells[4].innerText = "$" + numberWithCommas((cantidad * precio).toFixed(2));

        calcularTotales();
    }

    // Función para agregar comas a los números
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Llamar a la función cuando se cargue la página
    window.onload = calcularTotales;
</script>

</body>
<footer></footer>
</html>
