<?php
include 'php/conexion.php';

// Insertar nuevo registro
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $mensaje = $_POST['mensaje'];
    
    $sql = "INSERT INTO contactos (nombre, mensaje) VALUES ('$nombre', '$mensaje')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Se ha agregado el contacto');
    </script>";
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

// Eliminar registro
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    
    $sql = "DELETE FROM contactos WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script type='text/javascript'>
        alert('Se ha eliminado el contacto');
    </script>";
    } else {
        echo "Error al eliminar: " . $conn->error;
    }

}

// Consultar registros
$sql = "SELECT * FROM contactos" ;
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
   <link rel="stylesheet" href="css/styles.css">
  
</head>
<body>

<div class="container">
    <!-- Formulario para agregar contacto -->
    <div class="form-container">
        <h2>Agregar Contacto</h2>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="mensaje">Mensaje:</label>
                <textarea name="mensaje" id="mensaje" required></textarea>
            </div>
            <button type="submit" name="agregar">Enviar</button>
        </form>
    </div>

    <!-- Tabla de contactos -->
    <div class="table-container">
        <h2>Contactos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Mensaje</th>
                    <th  style="width:500px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['mensaje']; ?></td>
                        <td>
                        <script>
                             function abrirVentanaEmergente(url) {
                           // Abrir una nueva ventana con el tamaño deseado
                            window.open(url, "popup", "width=600,height=400, top=200");
                            return false; // Evitar la acción por defecto del enlace
                           }
                          </script>


                       <a href="editar.php?id=<?php echo $row['id']; ?>" onclick="return abrirVentanaEmergente(this.href);">
                       <button id="btnactualizar">Actualizar</button>
                       </a>                  
                       <a href="index.php?eliminar=<?php echo $row['id']; ?>"><button id="btneliminar">Eliminar</button></a>
 
</head>
<body>



                    </style>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
