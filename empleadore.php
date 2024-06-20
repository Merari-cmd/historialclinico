<?php
session_start();
if (!isset($_SESSION['email'])) {
    echo '
    <style>
        body {
            font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background: linear-gradient(35deg, blue, green);
            background-size: cover;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .message-box {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: rgb(255, 0, 0);
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
    </style>
    <div class="message-box">
        <h1>Acceso no autorizado</h1>
        <p>No tienes permiso para acceder a esta página.</p>
        <button class="button" onclick="window.location.href=\'index.php\'">Volver a la página de inicio</button>
    </div>';
    exit();
}
?>

<?php

$host = "localhost";
$dbname = "registroclinico";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit;
}

$query = "SELECT id, nombre FROM sucursal";
$stmt = $pdo->query($query);

$sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de Empleado</title>
    <style>/* estilos_login.css */
/* estilos_login.css */

body {
    margin: 0;
    color: #6a6f8c;
    background: #c8c8c8;
    font: 600 16px/18px 'Open Sans', sans-serif;
}

.login-wrap {
    width: 100%;
    margin: auto;
    max-width: 450px; /* Ajusta el tamaño deseado */
    min-height: 1200px; /* Ajusta el tamaño deseado */
    position: relative;
    background:url(fnd.jpg) no-repeat center;
    box-shadow: 0 12px 15px rgba(0, 0, 0, 0.24), 0 17px 50px rgba(0, 0, 0, 0.19);
}

.login-html {
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 70px 60px 40px 60px;
    background: rgba(40, 57, 101, 0.9);
}

h1 {
    color: #fff;
    text-align: center;
    margin-bottom: 40px;
    font-size: 24px; /* Tamaño de fuente del título */
}

.form-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input, select {
    padding: 10px;
    border: none;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.1);
    color: #000; /* Cambiar color del texto a negro */
    font-size: 14px;
}

button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    padding: 10px 15px; /* Tamaño del botón */
    border-radius: 15px; /* Redondear los bordes */
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 14px; /* Tamaño del texto */
}

button:hover {
    background: rgba(17, 97, 238, 0.8);
}

.buttons-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}


</style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1>Registro de Empleado</h1>
            <form action="validaempleadore.php" method="post" class="form-container">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <br>

                <label for="apaterno">Apellido Paterno:</label>
                <input type="text" id="apaterno" name="apaterno" required>
                <br>

                <label for="amaterno">Apellido Materno:</label>
                <input type="text" id="amaterno" name="amaterno" required>
                <br>

                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option> 
                </select>
                <br>

                <label for="edad">Edad:</label>
                <input type="text" id="edad" name="edad" required>
                <br>

                <label for="tel">Teléfono:</label>
                <input type="tel" id="tel" name="tel" required>
                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <br>

                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <br>

                <label for="sucursal_id">Sucursal perteneciente:</label>
                <select id="sucursal_id" name="sucursal_id" required>
                    <?php
                    foreach ($sucursales as $sucursal) {
                        echo '<option value="' . $sucursal['id'] . '">' . $sucursal['nombre'] . '</option>';
                    }
                    ?>
                </select>
                <br>

               <button type="submit">Registrar</button>
            </form>
             
            <div class="buttons-container">
                <button class="button" onclick="location.href='principaladministrador.php'">Salir</button>
            </div>
        </div>
    </div>
</body>
</html>