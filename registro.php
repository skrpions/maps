<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bsmapas";

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $cuenca = $_POST["cuenca"];
    $descripcion = $_POST["descripcion"];
    $videoUrl = $_POST["videoUrl"];
    $latitud = $_POST["latitud"];
    $longitud = $_POST["longitud"];

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO mapa (idmapa, cuenca, descripcion, videoUrl, lat, lng) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    // Bind de los parámetros y ejecución de la sentencia
    $stmt->bind_param("ssssdd", $id, $cuenca, $descripcion, $videoUrl, $latitud, $longitud);

    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error al registrar los datos: " . $stmt->error;
    }

    // Cerrar la sentencia y la conexión
    $stmt->close();
    $conn->close();
}
?>
