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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente</title>
    <style>
        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

        .login-wrap {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 2100px;
            position: relative;
            background:url(fnd.jpg) no-repeat center;
            box-shadow: 0 12px 15px rgba(0, 0, 0, 0.24), 0 17px 50px rgba(0, 0, 0, 0.19);
            border-radius: 15px; /* Agregar radio de bordes */
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
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            margin-top: 15px;
            color: #fff;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #000;
            font-size: 14px;
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 10px 5px;
            border-radius: 15px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 14px;
        }

        .button:hover {
            background: rgba(17, 97, 238, 0.8);
        }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1>Registro de Paciente</h1>
            <form action="validapacientere.php" method="post" class="form-container">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="apaterno">Apellido Paterno:</label>
                <input type="text" id="apaterno" name="apaterno" required>
                
                <label for="amaterno">Apellido Materno:</label>
                <input type="text" id="amaterno" name="amaterno" required>
                
                <label for="sexo">Sexo:</label>
                <select id="sexo" name="sexo" required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" required>
                
                <label for="tel">Teléfono:</label>
                <input type="tel" id="tel" name="tel" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                
                <label for="sucursal_id">Sucursal perteneciente:</label>
                <select id="sucursal_id" name="sucursal_id" required>
                    <?php
                    // Conexión a la base de datos
                    $host = "localhost";
                    $dbname = "registroclinico";
                    $username = "root";
                    $password = "";

                    try {
                        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo "Error al conectar a la base de datos: " . $e.getMessage();
                        exit;
                    }

                    $query = "SELECT id, nombre FROM sucursal";
                    $stmt = $pdo->query($query);
                    $sucursales = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($sucursales as $sucursal) {
                        echo '<option value="' . $sucursal['id'] . '">' . $sucursal['nombre'] . '</option>';
                    }
                    ?>
                </select>
                
                <h1>DATOS MÉDICOS</h1>
                <label for="glucosa">Glucosa (mg/dL):</label>
                <input type="number" step="0.01" id="glucosa" name="glucosa" required>
                
                <label for="urea">Urea (mg/dL):</label>
                <input type="number" step="0.01" id="urea" name="urea" required>
                
                <label for="trigliceridos">Triglicéridos (mg/dL):</label>
                <input type="number" step="0.01" id="trigliceridos" name="trigliceridos" required>
                
                <label for="creatinina">Creatinina (mg/dL):</label>
                <input type="number" step="0.01" id="creatinina" name="creatinina" required>
                
                <label for="acido">Ácido Úrico (mg/dL):</label>
                <input type="number" step="0.01" id="acido" name="acido" required>
                
                <label for="colesterol">Colesterol Total (mg/dL):</label>
                <input type="number" step="0.01" id="colesterol" name="colesterol" required>
                
                <label for="hdl">HDL (mg/dL):</label>
                <input type="number" step="0.01" id="hdl" name="hdl" required>
                
                <label for="ldl">LDL (mg/dL):</label>
                <input type="number" step="0.01" id="ldl" name="ldl" required>
                
                <div class="buttons-container">
                    <input type="submit" value="Registrar" class="button">
                </div>
            </form>
            <br>
              <div class="buttons-container">
                <button class="button" onclick="location.href='principalempleado.php'">Salir</button>
            </div>
        </div>
    </div>
</body>
</html>
