<?php
$host = "localhost";
$dbname = "registroclinico";
$username = "root";
$password = "";

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

function validar_dato($dato) {
    // Limpiar y estandarizar el dato
    return htmlspecialchars(strip_tags(trim($dato)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y validación de datos
    $nombre = validar_dato($_POST['nombre']);
    $apaterno = validar_dato($_POST['apaterno']);
    $amaterno = validar_dato($_POST['amaterno']);
    $sexo = validar_dato($_POST['sexo']);
    $edad = filter_var($_POST['edad'], FILTER_VALIDATE_INT);
    $tel = preg_match("/^\d{10}$/", $_POST['tel']) ? $_POST['tel'] : false;
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $contrasena = password_hash(validar_dato($_POST['contrasena']), PASSWORD_BCRYPT);
    $sucursal_id = filter_var($_POST['sucursal_id'], FILTER_VALIDATE_INT);

    $errores = [];

    // Validaciones adicionales para nombres y apellidos
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $nombre)) {
        $errores[] = "El nombre solo puede contener letras, espacios y caracteres especiales como ñ y acentos.";
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $apaterno)) {
        $errores[] = "El apellido paterno solo puede contener letras, espacios y caracteres especiales como ñ y acentos.";
    }
    if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/", $amaterno)) {
        $errores[] = "El apellido materno solo puede contener letras, espacios y caracteres especiales como ñ y acentos.";
    }
    if (!$edad || $edad < 18) {
        $errores[] = "La edad debe ser mayor o igual a 18.";
    }
    if (!$tel) {
        $errores[] = "El teléfono debe contener exactamente 10 números.";
    }
    if (!$email) {
        $errores[] = "El email no es válido.";
    }

    // Verificar si el correo ya existe
    if (empty($errores)) {
        $query_verificar_email = "SELECT id FROM empleado WHERE email = :email";
        $stmt_verificar_email = $pdo->prepare($query_verificar_email);
        $stmt_verificar_email->bindParam(':email', $email);
        $stmt_verificar_email->execute();

        if ($stmt_verificar_email->rowCount() > 0) {
            $errores[] = "El correo electrónico ya está registrado.";
        }
    }

    if (empty($errores)) {
        $query = "INSERT INTO empleado (nombre, apaterno, amaterno, sexo, edad, tel, email, contrasena, sucursal_id) 
                  VALUES (:nombre, :apaterno, :amaterno, :sexo, :edad, :tel, :email, :contrasena, :sucursal_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apaterno', $apaterno);
        $stmt->bindParam(':amaterno', $amaterno);
        $stmt->bindParam(':sexo', $sexo);
        $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':sucursal_id', $sucursal_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Registro exitoso
            echo "<script>alert('Registro exitoso.'); window.location.href = 'registroempleado.php';</script>";
            exit;
        } else {
            echo "<script>alert('Error al registrar el empleado.');</script>";
            exit;
        }
    } else {
        echo "<script>";
        foreach ($errores as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
        exit;
    }
}
?>
