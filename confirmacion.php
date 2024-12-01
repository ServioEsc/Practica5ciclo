<!-- confirmacion.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inscripciones_cursos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

$sql = "SELECT nombre, curso FROM inscripciones WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = htmlspecialchars($row['nombre']);
    $curso = htmlspecialchars($row['curso']);
} else {
    die("No se encontró el registro.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Inscripción</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Confirmacion de la Inscripcion</h1>
    <nav>
        <ul>
            <li><a href="index.html">Inicio</a></li>
            <li><a href="ver_inscripcion.php">Ver Inscripciones</a></li>
        </ul>
    </nav>
    <div class="confirmation-container">
        <h1>Inscripción Exitosa</h1>
        <p>Gracias, <strong><?php echo $nombre; ?></strong>, por inscribirte en el curso de <strong><?php echo $curso; ?></strong>. Tu inscripción ha sido registrada exitosamente.</p>
        <a href="ver_inscripciones.php" class="button">Ver inscripciones por curso</a>
    </div>
</body>
</html>
