<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parcial"; // Cambia el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM contactos WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $mensaje = $_POST['mensaje'];
    
    $sql = "UPDATE contactos SET nombre='$nombre', mensaje='$mensaje' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        window.opener.location.href = 'index.php'; // Redirigir a la página principal
        window.close(); // Cerrar la ventana emergente
    </script>";

     
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editar.css">
  
    <title>Editar Contacto</title>
</head>
<body>

<h2>Editar Contacto</h2>
<form action="" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>" required>
    
    <label for="mensaje">Mensaje:</label>
    <textarea name="mensaje" id="mensaje" required><?php echo $row['mensaje']; ?></textarea>
    
    <button type="submit">Actualizar</button>
   
</form>

</body>
</html>

<?php
$conn->close();
?>
