<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Este es el inicio Admin</title>

    <!-- Enlaces a Bootstrap CSS y Bootstrap temática (Bootswatch) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/minty/bootstrap.min.css">

    <!-- Enlace a FontAwesome para los íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Agrega tus estilos CSS personalizados -->
    <link rel="stylesheet" href="../../../assets/css/side.css">
    <link rel="stylesheet" href="../../../assets/css/estilos.css">
</head>
<body>
    <!-- Dashboard -->
    <div class="dashboard-container">
        <div class="sidebar">
            <h2>Admin</h2>
            <button class="btn toggle-button" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="Historico_compras.php">
                        <i class="fas fa-history"></i> Historico Compras
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="inicio_Productos_Facturacion.php">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="#">
                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                    </a>
                </li>
                <!-- Agrega más elementos de menú aquí -->
            </ul>
        </div>

        <div class="main-content">
            <!-- Contenido principal -->

            <div class="card">
                <h1>Lista de Productos</h1>
            </div>
            <div class="card-header"></div>
            <div class="carrito">
    <h2>Carrito de Compras</h2>
    <ul id="carrito-lista"></ul>
    <p>Total: <span id="carrito-total">0.00</span></p>
</div>

<!-- Input para seleccionar al cliente -->
<label for="cliente">Cliente:</label>
<select id="cliente" name="cliente">
    <?php
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para obtener a todos los usuarios de la tabla
    $sql = "SELECT `id_Usuario`, `Nombre`, `Correo`, `Contraseña`, `Nivel`, `Cod_Usuario` FROM `tb_usuario`";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['Cod_Usuario'] . '">' . $row['Nombre'] . '</option>';
        }
    }

    // Cierra la conexión
    $conn->close();
    ?>
</select>

<!-- Input para agregar el NIT del cliente -->
<label for="nit">NIT:</label>
<input type="text" id="nit" name="nit" />

<!-- Campo de fecha de emisión de la factura (puede ser un campo oculto si se genera automáticamente) -->
<input type="hidden" id="fecha_emision" name="fecha_emision" value="<?php echo date('Y-m-d'); ?>" />

<!-- Botón para generar la compra -->
<div class="col text-end">
    <button type="button" class="btn btn-success" id="generarCompraBtn">
        <i class="fas fa-shopping-cart"></i> Generar Compra
    </button>
</div>

            <div class="col text-end">
                <button type="button" class="btn btn-danger" id="cancelarCompraBtn" data-toggle="modal" data-target="#insertarModal">
                    <i class="fas fa-ban"></i> Cancelar Compra
                </button>
            </div>

            <div class="card-body">
                <table class="table" id="tabla-productos">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Conexión a la base de datos
                        $conn = new mysqli("localhost", "root", "", "bd_petcorp_system");

                        // Verifica la conexión
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }

                        // Consulta SQL para obtener todos los productos
                        $sql = "SELECT `ID_Articulo`, `Nombre_Articulo`, `Cantidad_Stock`, `Precio_Unidad`, `descripción`, `Imagen_Articulo` FROM `inventario`";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row['ID_Articulo'] . '</td>';
                                echo '<td>' . $row['Nombre_Articulo'] . '</td>';
                                echo '<td>' . $row['descripción'] . '</td>';
                                echo '<td>Q' . $row['Precio_Unidad'] . '</td>';
                                echo '<td>' . $row['Cantidad_Stock'] . '</td>';
                                echo '<td><a href="' . $row['Imagen_Articulo'] . '" target="_blank">Ver Imagen</a></td>';
                                echo '<td>';
                                echo '<a href="#" class="btn btn-success agregar-al-carrito" data-producto-id="' . $row['ID_Articulo'] . '">Agregar al carrito</a>';

                                echo '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="7">No se encontraron productos en la base de datos.</td></tr>';
                        }
                        // Cierra la conexión
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pie de página, enlaces a JavaScript y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Función para agregar un producto al carrito
        function agregarAlCarrito(producto) {
            const carritoLista = document.getElementById("carrito-lista");
            const carritoTotal = document.getElementById("carrito-total");

            const productoHTML = document.createElement("li");
            productoHTML.innerHTML = `
                <strong>${producto.nombre}</strong> - Precio: Q${producto.precio.toFixed(2)}
            `;

            carritoLista.appendChild(productoHTML);

            // Actualiza el total
            const totalActual = parseFloat(carritoTotal.textContent);
            carritoTotal.textContent = (totalActual + producto.precio).toFixed(2);
        }
        // Agrega un listener de clic a los botones de carrito
        const botonesCarrito = document.querySelectorAll(".agregar-al-carrito");
        botonesCarrito.forEach((boton) => {
            boton.addEventListener("click", function (e) {
                e.preventDefault();

                const productoId = e.target.getAttribute("data-producto-id");
                const productoNombre = e.target.parentElement.parentElement.querySelector("td:nth-child(2)").textContent;
                const productoPrecio = parseFloat(e.target.parentElement.parentElement.querySelector("td:nth-child(4)").textContent.replace("Q", ""));

                const producto = {
                    nombre: productoNombre,
                    precio: productoPrecio,
                };

                // Agrega el producto al carrito
                agregarAlCarrito(producto);
            });
        });
    </script>
    <script>
        // Función para limpiar el carrito de compras
        function limpiarCarrito() {
            const carritoLista = document.getElementById("carrito-lista");
            const carritoTotal = document.getElementById("carrito-total");

            // Limpia la lista de productos en el carrito
            carritoLista.innerHTML = '';

            // Restablece el total a 0
            carritoTotal.textContent = '0.00';
        }

        // Agrega un listener de clic al botón "Cancelar Compra"
        const cancelarCompraBtn = document.getElementById("cancelarCompraBtn");
        cancelarCompraBtn.addEventListener("click", function (e) {
            e.preventDefault();
            limpiarCarrito();
        });
    </script>
<script>
// Función para generar una compra
function generarCompra() {
    const carritoLista = document.getElementById("carrito-lista").getElementsByTagName("li");
    const carritoTotal = document.getElementById("carrito-total");
    const descripcionServicios = [];

    // Recorre los elementos del carrito y obtén sus descripciones
    for (let i = 0; i < carritoLista.length; i++) {
        descripcionServicios.push(carritoLista[i].innerText);
    }

    const montoTotal = parseFloat(carritoTotal.textContent.replace("Q", ""));

    // Obtenemos el valor del cliente seleccionado y el NIT
    const cliente = document.getElementById("cliente").value;
    const nit = document.getElementById("nit").value;

    // Fecha de emisión ya está en el campo oculto

    // Envía los datos al servidor usando una solicitud AJAX
    $.ajax({
        url: 'guardar_compra.php',
        method: 'POST',
        data: { 
            descripcionServicios: JSON.stringify(descripcionServicios), 
            montoTotal: montoTotal,
            cliente: cliente,
            nit: nit,
            fecha_emision: document.getElementById("fecha_emision").value
        },
        success: function (response) {
            // Realizar acciones adicionales después de guardar la compra.
            alert(response); // Muestra la respuesta del servidor (puedes personalizarlo)
        }
    });

    // Limpia el carrito
    limpiarCarrito();
}
</script>

<script>
    // Función para limpiar el carrito de compras
    function limpiarCarrito() {
        const carritoLista = document.getElementById("carrito-lista");
        const carritoTotal = document.getElementById("carrito-total");

        // Limpia la lista de productos en el carrito
        carritoLista.innerHTML = '';

        // Restablece el total a 0
        carritoTotal.textContent = '0.00';
    }
</script>

<script>
    $(document).ready(function() {
        $('#generarCompraBtn').click(function() {
            generarCompra();
        });
    });
</script>

</body>
</html>
