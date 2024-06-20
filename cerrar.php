<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
  <link rel="icon" href="icono.ico">
  
  
</head>


<body>
<?php
session_start();
$id = session_id();
error_reporting(0); 
$varsesion = $_SESSION['email'];

if ($varsesion == null || $varsesion == '') {
    echo '
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acceso no autorizado</title>
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
    </head>
    <body>
        <div class="message-box">
            <h1>Acceso no autorizado</h1>
            <p>No tienes permiso para acceder a esta página.</p>
            <button class="button" onclick="window.location.href=\'index.php\'">Volver a la página de inicio</button>
        </div>
    </body>
    </html>';
    die();
}

session_destroy();
header("Location: index.php"); 
?>

</body>
</html>