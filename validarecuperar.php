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
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];
$nueva_contrasena = $_POST['nueva_contrasena'];
$confirmar_contrasena = $_POST['confirmar_contrasena'];

if (empty($email) || empty($pregunta) || empty($respuesta) || empty($nueva_contrasena) || empty($confirmar_contrasena)) {
    echo "<script>alert('Todos los campos son obligatorios.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=recuperar.php'>";
    exit();
}

if ($nueva_contrasena !== $confirmar_contrasena) {
    echo "<script>alert('Las contraseñas no coinciden.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=recuperar.php'>";
    exit();
}

function validar_usuario($conexion, $email, $tabla) {
    $sql = "SELECT * FROM $tabla WHERE BINARY email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

function actualizar_pregunta_respuesta($conexion, $tabla, $email, $pregunta, $respuesta) {
    $sql = "UPDATE $tabla SET pregunta = ?, respuesta = ? WHERE BINARY email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('sss', $pregunta, $respuesta, $email);
    return $stmt->execute();
}

function actualizar_contrasena($conexion, $tabla, $email, $nueva_contrasena) {
    $sql = "UPDATE $tabla SET contrasena = ? WHERE BINARY email = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param('ss', password_hash($nueva_contrasena, PASSWORD_BCRYPT), $email);
    return $stmt->execute();
}

$roles = [
    'empleado' => 'empleado',
    'pacientes' => 'pacientes'
];

$usuario_valido = false;

foreach ($roles as $rol => $tabla) {
    if (validar_usuario($conexion, $email, $tabla)) {
        $usuario_valido = true;
        if (actualizar_pregunta_respuesta($conexion, $tabla, $email, $pregunta, $respuesta) && 
            actualizar_contrasena($conexion, $tabla, $email, $nueva_contrasena)) {
            echo "<script>alert('Contraseña y pregunta/ respuesta actualizadas con éxito para $rol.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=recuperar.php'>";
        } else {
            echo "<script>alert('Error al actualizar la información.');</script>";
            echo "<meta http-equiv='refresh' content='0;url=recuperar.php'>";
        }
        break;
    }
}

if (!$usuario_valido) {
    echo "<script>alert('La pregunta secreta y la respuesta no coinciden.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=recuperar.php'>";
}

$conexion->close();
?>
