<?php



// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Problema al intentar guardar");
    exit();
}

// Obtener los datos del formulario
$idItems = json_decode($_POST['id_items']);
$totalUnidades = $_POST['total_unidades'];
$totalRenta = $_POST['total_renta'];

// Insertar los datos en la tabla carrito
$stmt = $conn->prepare("INSERT INTO carrito (total_unidades, total_renta) VALUES (?, ?)");
$stmt->bind_param("id", $totalUnidades, $totalRenta);

// Ejecutar la inserción en la tabla carrito
$stmt->execute();

// Verificar si se insertó el registro en la tabla carrito
if ($stmt->affected_rows > 0) {
    // Obtener el ID del registro recién insertado
    $idCarrito = $stmt->insert_id;

    // Preparar la inserción en la tabla de relación carrito_item
    $stmt = $conn->prepare("INSERT INTO carrito_item (id_carrito, id_item) VALUES (?, ?)");
    $stmt->bind_param("ii", $idCarrito, $idItem);

    // Iterar sobre las id_item recibidas y asociarlas al registro de carrito
    foreach ($idItems as $idItem) {
        $stmt->execute();
    }

    // Verificar si se insertaron los datos correctamente en la tabla de relación
    if ($stmt->affected_rows > 0) {
        echo "Carrito guardado con éxito.";
    } else {
        echo "Error al asociar los items al carrito. Inténtalo de nuevo más tarde.";
    }
} else {
    echo "Error al guardar el carrito. Inténtalo de nuevo más tarde.";
}

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
?>

