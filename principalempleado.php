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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>PRINCIPAL EMPLEADO</title>
    <style>
        /* estilos.css */
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
            min-height: 670px;
            position: relative;
            background:url(fnd.jpg) no-repeat center;
            background-size: cover;
            box-shadow: 0 12px 15px rgba(0, 0, 0, 0.24), 0 17px 50px rgba(0, 0, 0, 0.19);
           
        }

        .login-html {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 70px 60px 40px 60px;
            background: rgba(40, 57, 101, 0.9);
            border-radius: 15px;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 40px;
            font-size: 24px; /* Tamaño de fuente del título */
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            padding: 15px 20px;
            border-radius: 15px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 16px; /* Tamaño del texto */
        }

        .button:hover {
            background: rgba(17, 97, 238, 0.8);
        }

    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1>Bienvenido empleado</h1>
            <div class="buttons-container">
                <button class="button" onclick="location.href='verclientes.php'">Ver Pacientes</button>
                <button class="button" onclick="location.href='pacientere.php'">Registrar</button>
                <button class="button" onclick="location.href='cerrar.php'">Salir</button>
            </div>
        </div>
    </div>
</body>
</html>
