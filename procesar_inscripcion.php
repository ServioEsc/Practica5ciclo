<!-- procesar_inscripcion.php -->
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

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$curso = $_POST['curso'];

$nombre = $conn->real_escape_string($nombre);
$email = $conn->real_escape_string($email);
$telefono = $conn->real_escape_string($telefono);
$curso = $conn->real_escape_string($curso);

$sql = "INSERT INTO inscripciones (nombre, email, telefono, curso) VALUES ('$nombre', '$email', '$telefono', '$curso')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo '<form id="redirectForm" action="confirmacion.php" method="post">';
    echo '<input type="hidden" name="id" value="' . $last_id . '">';
    echo '</form>';
    echo '<script type="text/javascript">document.getElementById("redirectForm").submit();</script>';
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
