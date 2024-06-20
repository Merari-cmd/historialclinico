<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registro de Sucursal</title>
</head>
<body>
<?php
$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'registroclinico';
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$rfc = $_POST['rfc'];

if (empty($nombre) || empty($direccion) || empty($tel) || empty($email) || empty($rfc)) {
    echo "<script>alert('Todos los campos son obligatorios.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

if (!preg_match('/^[a-zA-Z\s]+$/', $nombre) || !preg_match('/^[a-zA-Z\s]+$/', $direccion)) {
    echo "<script>alert('El nombre y la dirección solo pueden contener letras y espacios.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

if (!preg_match('/^\d{10}$/', $tel)) {
    echo "<script>alert('El teléfono debe contener exactamente 10 dígitos.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

$regex_email = '/^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,}$/';
if (!preg_match($regex_email, $email)) {
    echo "<script>alert('El email no es válido.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

if (!preg_match('/^[a-zA-Z0-9]{12}$/', $rfc)) {
    echo "<script>alert('El RFC debe contener exactamente 12 caracteres alfanuméricos.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

$email_check_query = "SELECT * FROM sucursal WHERE email = ?";
$stmt = $conexion->prepare($email_check_query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('El email ya está registrado.'); window.location.href='sucursalesre.php';</script>";
    exit();
}

$sql = "INSERT INTO sucursal (nombre, direccion, tel, email, rfc) VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('sssss', $nombre, $direccion, $tel, $email, $rfc);

if ($stmt->execute()) {
    echo "<script>alert('Sucursal registrada exitosamente.'); window.location.href='sucursalesre.php';</script>";
} else {
    echo "<script>alert('Error al registrar la sucursal: " . $stmt->error . "'); window.location.href='sucursalesre.php';</script>";
}

$stmt->close();
$conexion->close();
?>
</body>
</html>
