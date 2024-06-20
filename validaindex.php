
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"> 
</head>
<body>
<?php
session_start();

$servidor = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_datos = 'registroclinico';

$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$captcha_input = $_POST['captcha_input'];
$captcha = $_SESSION['captcha'] ?? '';

if ($captcha_input !== $captcha) {
    echo "<script>alert('El CAPTCHA es incorrecto.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
    exit();
}

function validar_usuario($conexion, $email, $contrasena, $tabla) {
    $sql = "SELECT * FROM $tabla WHERE BINARY email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        }
    }
    return false;
}

$usuario = validar_usuario($conexion, $email, $contrasena, 'administrador');
if ($usuario) {
    $_SESSION['email'] = $email;
    echo "<script>alert('Inicio de sesión exitoso como Administrador.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=principaladministrador.php'>";
    exit();
}

$usuario = validar_usuario($conexion, $email, $contrasena, 'empleado');
if ($usuario) {
    $_SESSION['email'] = $email;
    echo "<script>alert('Inicio de sesión exitoso como Empleado.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=principalempleado.php'>";
    exit();
}

$usuario = validar_usuario($conexion, $email, $contrasena, 'pacientes');
if ($usuario) {
    $_SESSION['email'] = $email;
    echo "<script>alert('Inicio de sesión exitoso como Paciente.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=principalcliente.php'>";
    exit();
}

echo "<script>alert('Email o contraseña incorrectos.');</script>";
echo "<meta http-equiv='refresh' content='0;url=index.php'>";

$conexion->close();
?>
</body>
</html>
