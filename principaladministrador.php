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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
    <title>PRINCIPAL ADMINISTRADOR</title>
</head>
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
    min-height: 670px;
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
    margin-bottom: 40px; /* Agregar margen al título */
}

.buttons-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.button {
    background: rgba(255, 255, 255, 0.1);
    border: none;
    padding: 10px 5px; /* Disminuir el tamaño del botón */
    border-radius: 15px; /* Redondear los bordes */
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: background 0.3s ease;
    font-size: 14px; /* Reducir el tamaño del texto */
}

.button:hover {
    background: rgba(17, 97, 238, 0.8);
}


</style>


<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1>Bienvenido Administrador</h1>
            <div class="buttons-container">
                <button class="button" onclick="location.href='sucursalesre.php'">Registro de Sucursales</button>
                <button class="button" onclick="location.href='empleadore.php'">Registro de Empleados</button>
                <button class="button" onclick="location.href='informacionclientes.php'">Información de Empleados</button>
                <button class="button" onclick="location.href='cerrar.php'">Salir</button>
            </div>
        </div>
    </div>
</body>
</html>
