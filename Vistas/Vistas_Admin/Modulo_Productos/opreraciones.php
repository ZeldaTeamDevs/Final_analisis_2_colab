<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Operación de inserción
if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['stock']) && isset($_POST['imagen'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];

    $sql = "INSERT INTO `inventario` (`Nombre_Articulo`, `descripción`, `Precio_Unidad`, `Cantidad_Stock`, `Imagen_Articulo`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $nombre, $descripcion, $precio, $stock, $imagen);
    
    if ($stmt->execute()) {
        // Operación de inserción exitosa
        header("Location: inicio_Productos_Facturacion.php");
        exit();
    } else {
        echo "Error al insertar el producto: " . $stmt->error;
    }

    $stmt->close();
}

// Operación de edición
if (isset($_POST['producto_id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['stock'])) {
    $producto_id = $_POST['producto_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    $sql = "UPDATE `inventario` SET `Nombre_Articulo` = ?, `descripción` = ?, `Precio_Unidad` = ?, `Cantidad_Stock` = ? WHERE `ID_Articulo` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $producto_id);
    
    if ($stmt->execute()) {
        // Operación de edición exitosa
        header("Location: inicio_Productos_Facturacion.php");
        exit();
    } else {
        echo "Error al editar el producto: " . $stmt->error;
    }

    $stmt->close();
}

// Operación de eliminación
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    $sql = "DELETE FROM `inventario` WHERE `ID_Articulo` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    
    if ($stmt->execute()) {
        // Operación de eliminación exitosa
        header("Location: inicio_Productos_Facturacion.php");
        exit();
    } else {
        echo "Error al eliminar el producto: " . $stmt->error;
    }

    $stmt->close();
}

// Cierra la conexión
$conn->close();
?>
