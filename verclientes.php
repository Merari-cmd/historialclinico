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
    <title>Registro de Pacientes</title>
    <style>
        /* estilos_login.css */
        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

       

       

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px; /* Tamaño de fuente del título */
        }

      

        input, select {
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: #000; /* Cambiar color del texto a negro */
            font-size: 14px;
        }

        .button {
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

        .button:hover {
            background: rgba(17, 97, 238, 0.8);
        }

        .tabla-empleados {
            width: 100%;
            margin-top: 20px;
            color: #fff;
            font-size: 14px;
        }

        .tabla-empleados th, .tabla-empleados td {
            padding: 10px;
            text-align: center;
        }

        .tabla-empleados th {
            background-color: #2a2f52; /* Cambiar el color del encabezado a un tono más oscuro */
            font-weight: bold;
        }

        .tabla-empleados tr:nth-child(even) {
            background-color: #3e4467; /* Cambiar el color de fondo de las filas pares */
        }

        .tabla-empleados tr:hover {
            background-color: #4d5189; /* Cambiar el color de fondo de las filas al pasar el mouse */
        }
    </style>
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

    $sql = "SELECT * FROM pacientes WHERE sucursal_id = 1";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='login-wrap'>";
        echo "<div class='login-html'>";
        echo "<h1>Pacientes Registrados</h1>";
        echo "<table class='tabla-empleados'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombre</th>";
        echo "<th>Apellido Paterno</th>";
        echo "<th>Apellido Materno</th>";
        echo "<th>Sexo</th>";
        echo "<th>Edad</th>";
        echo "<th>Teléfono</th>";
        echo "<th>Email</th>";
        echo "<th>Sucursal ID</th>";
        echo "</tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["apaterno"] . "</td>";
            echo "<td>" . $row["amaterno"] . "</td>";
            echo "<td>" . $row["sexo"] . "</td>";
            echo "<td>" . $row["edad"] . "</td>";
            echo "<td>" . $row["tel"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["sucursal_id"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<br>";
        echo "<div>";
        echo "<button class='button' onclick=\"location.href='principalempleado.php'\">Salir</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "0 resultados";
    }

    $conexion->close();
    ?>
</body>
</html>
