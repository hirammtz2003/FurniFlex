<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    $id_articulo = $_POST['id_articulo'];

    // Preparar la consulta SQL para insertar los datos en la tabla item_articulo
    $sql_insert = "INSERT INTO item_articulo (id_artículo, Nombre, Precio, Cantidad) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issi", $id_articulo, $nombre, $precio, $cantidad);

    // Ejecutar la consulta de inserción
    if ($stmt_insert->execute()) {
        // Actualizar Cantidad_disponible en artículo_mobiliario
        $sql_update = "UPDATE artículo_mobiliario SET Cantidad_disponible = Cantidad_disponible - ? WHERE id_artículo = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $cantidad, $id_articulo);
        $stmt_update->execute();

        echo 'success';
    } else {
        echo 'error';
    }

    // Cerrar las consultas preparadas y la conexión
    $stmt_insert->close();
    $stmt_update->close();
    $conn->close();
}
?>
