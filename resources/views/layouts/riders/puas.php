<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$database = "administracion";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombrePua = $_POST['nombrePua'];
$pregunta1 = $_POST['pregunta1'];
$pregunta2 = $_POST['pregunta2'];

// Preparar la consulta SQL para insertar datos en la tabla 'puas'
$sql = "INSERT INTO puas (localizacion, cantidad_de_personas, ultima_entrega, rider_creador, estado)
VALUES ('$nombrePua', '$pregunta1', '$pregunta2')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Pua creada correctamente";
} else {
    echo "Error al crear la pua: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

header("Location: rider.blade.php?message=Pua creada correctamente");
exit();
?>
