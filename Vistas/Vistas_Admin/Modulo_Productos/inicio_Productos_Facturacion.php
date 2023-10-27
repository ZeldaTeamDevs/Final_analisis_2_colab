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
                           <a href="Generar_Venta.php">
                               <i class="fas fa-shopping-cart"></i> Generar Compras
                           </a>
                       </li>
                       <li class="list-group-item">
                           <a href="Historico_compras.php">
                               <i class="fas fa-history"></i> Historico Compras
                           </a>
                       </li>
                       <li class="list-group-item">
                           <a href="../inicio_Admin.php">
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
                    <div class="card-header">
                        <div class="col text-end">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insertarModal">
                                Agregar Productos
                            </button>
                        </div>
                    </div>

                        <div class="card-body">
                            <input type="text" id="busqueda" class="form-control mb-3" placeholder="Buscar productos">
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
                                            echo '<a href="#" class="btn btn-success" data-toggle="modal" data-target="#editarModal" data-producto-id="' . $row['ID_Articulo'] . '" data-nombre="' . $row['Nombre_Articulo'] . '" data-descripcion="' . $row['descripción'] . '" data-precio="' . $row['Precio_Unidad'] . '" data-stock="' . $row['Cantidad_Stock'] . '"><i class="fas fa-edit"></i> Editar</a>';
                                            echo '<a href="#" class="btn btn-danger" data-toggle="modal" data-target="#eliminarModal" data-producto-id="' . $row['ID_Articulo'] . '"><i class="fas fa-trash"></i> Eliminar</a>';
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
                <!-- Modal de Inserción -->
            <div class="modal fade" id="insertarModal" tabindex="-1" aria-labelledby="insertarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="insertarModalLabel">Insertar Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="opreraciones.php" method="POST">
                                <div class="mb-3">
                                    <label for="insertar-nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="insertar-nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="insertar-descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="insertar-descripcion" name="descripcion" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="insertar-precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="insertar-precio" name="precio" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for="insertar-stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="insertar-stock" name="stock" required>
                                </div>
                                <div class="mb-3">
                                    <label for="insertar-imagen" class="form-label">URL de la Imagen</label>
                                    <input type="text" class="form-control" id="insertar-imagen" name="imagen" required>
                                </div>
                                <button type="submit" class="btn btn-success">Insertar Producto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>          
            <!-- Modal de Edición -->
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarModalLabel">Editar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="opreraciones.php" method="POST">
                                <div class="mb-3">
                                    <label for="editar-nombre" class="form-label">Nombre del Producto</label>
                                    <input type="text" class="form-control" id="editar-nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editar-descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="editar-descripcion" name="descripcion" rows="4"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="editar-precio" class="form-label">Precio</label>
                                    <input type="number" class="form-control" id="editar-precio" name="precio" step="0.01" required>
                                </div>
                                <div class="mb-3">
                                    <label for "editar-stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="editar-stock" name="stock" required>
                                </div>
                                <input type="hidden" id="producto-id" name="producto_id">
                                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                            
            <!-- Modal de Confirmación de Eliminación -->
            <div class="modal fade" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este producto?
                        </div>
                        <div class="modal-footer">
                            <form action="opreraciones.php" method="POST">
                                <input type="hidden" id="eliminar-producto-id" name="producto_id">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


    </div>

    <!-- Enlaces a Bootstrap JS, jQuery y tus scripts personalizados -->

    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="../../../assets/js/side.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Obtener el botón "Agregar Productos"
            var agregarProductosButton = document.querySelector("#agregar-productos-button");
        
            // Obtener el modal de inserción
            var insertarModal = document.querySelector("#insertarModal");
        
            // Agregar un manejador de eventos al botón
            agregarProductosButton.addEventListener("click", function() {
                // Abrir el modal de inserción
                var modal = new bootstrap.Modal(insertarModal);
                modal.show();
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            // Captura los valores al hacer clic en "Editar"
            $('#editarModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var producto_id = button.data('producto-id');
                var nombre = button.data('nombre');
                var descripcion = button.data('descripcion');
                var precio = button.data('precio');
                var stock = button.data('stock');

                var modal = $(this);
                modal.find('#producto-id').val(producto_id);
                modal.find('#editar-nombre').val(nombre);
                modal.find('#editar-descripcion').val(descripcion);
                modal.find('#editar-precio').val(precio);
                modal.find('#editar-stock').val(stock);
            });

            // Captura el valor al hacer clic en "Eliminar"
            $('#eliminarModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var producto_id = button.data('producto-id');

                var modal = $(this);
                modal.find('#eliminar-producto-id').val(producto_id);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            // Inicializar DataTable
            var table = $('#tabla-productos').DataTable();

            // Agregar funcionalidad de búsqueda
            $('#busqueda').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
</body>
</html>
