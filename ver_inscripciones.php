<!-- ver_inscripciones.php -->
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

$sql = "SELECT curso, nombre, email, telefono FROM inscripciones ORDER BY curso";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripciones por Curso</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Inscripciones por Curso</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="info-cursos.php">Informacion de los cursos</a></li>
                <li><a href="ver_inscripcion.php">Ver Inscripciones</a></li>
            </ul>
        </nav>
    <div class="course-container">
        <?php
        $curso_actual = "";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["curso"] != $curso_actual) {
                    if ($curso_actual != "") {
                        echo "</ul></div>";
                    }
                    $curso_actual = $row["curso"];
                    echo'<div class="course-card">';
                    echo "<h2>Curso: " . htmlspecialchars($curso_actual) . "</h2>";
                    echo "<ul>";
                }
                echo "<li>Nombre: " . htmlspecialchars($row["nombre"]) . ", Email: " . htmlspecialchars($row["email"]) . ", Teléfono: " . htmlspecialchars($row["telefono"]) . "</li>";
            }
            echo "</ul></dic>";
        } else {
            echo "<p>No hay inscripciones.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
