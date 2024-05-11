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
    </style>
</head>
<body>
<header>
    <a href="index.html" id="logoLink">
        <img src="logo.png" id="logoH" />
    </a>
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
                // Incluir el archivo de conexión a la base de datos
                include 'conexion.php';

                // Consulta SQL para obtener los registros de la tabla item_articulo
                $sql = "SELECT id_item, Nombre, Cantidad, Precio FROM item_articulo";
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

<script>
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
