<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PRINCIPAL ADMINISTRADOR</title>
</head>
<body>
    <?php
    // Inicialización de la conexión a la base de datos
    $host = "localhost";
    $dbname = "registroclinico";
    $username = "root";
    $password = "";

    $errores = [];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $errores[] = "Error al conectar a la base de datos: " . $e.getMessage();
    }

    // Captura y saneamiento de los datos enviados desde el formulario
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apaterno = filter_input(INPUT_POST, 'apaterno', FILTER_SANITIZE_STRING);
    $amaterno = filter_input(INPUT_POST, 'amaterno', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_SANITIZE_NUMBER_INT);
    $tel = filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_STRING);
    $sucursal_id = filter_input(INPUT_POST, 'sucursal_id', FILTER_SANITIZE_NUMBER_INT);
    $glucosa = filter_input(INPUT_POST, 'glucosa', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $urea = filter_input(INPUT_POST, 'urea', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $trigliceridos = filter_input(INPUT_POST, 'trigliceridos', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $creatinina = filter_input(INPUT_POST, 'creatinina', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $acido = filter_input(INPUT_POST, 'acido', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $colesterol = filter_input(INPUT_POST, 'colesterol', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $hdl = filter_input(INPUT_POST, 'hdl', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $ldl = filter_input(INPUT_POST, 'ldl', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Validaciones
    if (!$nombre || !preg_match("/^[a-zA-Z\s]+$/", $nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios.";
    }
    if (!$apaterno || !preg_match("/^[a-zA-Z\s]+$/", $apaterno)) {
        $errores[] = "El apellido paterno solo puede contener letras y espacios.";
    }
    if (!$amaterno || !preg_match("/^[a-zA-Z\s]+$/", $amaterno)) {
        $errores[] = "El apellido materno solo puede contener letras y espacios.";
    }
    if (!preg_match("/^\d{10}$/", $tel)) {
        $errores[] = "El teléfono debe contener exactamente 10 números.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El email no es válido.";
    }

    // Verificar si el correo ya existe
    if (empty($errores)) {
        $query_verificar_email = "SELECT id FROM pacientes WHERE email = :email";
        $stmt_verificar_email = $pdo->prepare($query_verificar_email);
        $stmt_verificar_email->bindParam(':email', $email);
        $stmt_verificar_email->execute();

        if ($stmt_verificar_email->rowCount() > 0) {
            $errores[] = "El correo electrónico ya está registrado.";
        }
    }

    // Si hay errores, mostrar mensajes y detener el proceso
    if (!empty($errores)) {
        echo "<script>";
        foreach ($errores as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
        echo "<br><button onclick=\"window.location.href = 'principalempleado.php';\">Regresar</button>";
        exit;
    }

    // Preparar la consulta SQL
    $query = "INSERT INTO pacientes 
              (nombre, apaterno, amaterno, sexo, edad, tel, email, contrasena, sucursal_id, glucosa, urea, trigliceridos, creatinina, acido, colesterol, hdl, ldl) 
              VALUES 
              (:nombre, :apaterno, :amaterno, :sexo, :edad, :tel, :email, :contrasena, :sucursal_id, :glucosa, :urea, :trigliceridos, :creatinina, :acido, :colesterol, :hdl, :ldl)";

    // Preparar el statement y ejecutar
    $stmt = $pdo->prepare($query);
    $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);
    $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $stmt->bindParam(':apaterno', $apaterno, PDO::PARAM_STR);
    $stmt->bindParam(':amaterno', $amaterno, PDO::PARAM_STR);
    $stmt->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    $stmt->bindParam(':edad', $edad, PDO::PARAM_INT);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':contrasena', $contrasena_hashed, PDO::PARAM_STR);
    $stmt->bindParam(':sucursal_id', $sucursal_id, PDO::PARAM_INT);
    $stmt->bindParam(':glucosa', $glucosa, PDO::PARAM_STR);
    $stmt->bindParam(':urea', $urea, PDO::PARAM_STR);
    $stmt->bindParam(':trigliceridos', $trigliceridos, PDO::PARAM_STR);
    $stmt->bindParam(':creatinina', $creatinina, PDO::PARAM_STR);
    $stmt->bindParam(':acido', $acido, PDO::PARAM_STR);
    $stmt->bindParam(':colesterol', $colesterol, PDO::PARAM_STR);
    $stmt->bindParam(':hdl', $hdl, PDO::PARAM_STR);
    $stmt->bindParam(':ldl', $ldl, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "<script>
                    alert('Paciente registrado exitosamente.');
                    window.location.href = 'pacientere.php';
                  </script>";
		
    } catch (PDOException $e) {
        $errores[] = "Error al registrar paciente: " . $e.getMessage();
    }

    if (!empty($errores)) {
        echo "<script>";
        foreach ($errores as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
        echo "<br><button onclick=\"window.location.href = 'principalempleado.php';\">Regresar</button>";
    }
    ?>
</body>
</html>
