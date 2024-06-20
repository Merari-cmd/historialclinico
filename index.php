
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"> 
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1 class="tab">INICIO DE SESIÓN</h1>
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
           

            <form action="validaindex.php" method="post" class="login-form">
                <div class="group">
                    <label for="email" class="label">Email:</label>
                    <input type="email" id="email" name="email" class="input" required>
                </div>

                <div class="group">
                    <label for="contrasena" class="label">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" class="input" required>
                </div>

                <?php
                session_start(); // Iniciar la sesión

                // Generación del CAPTCHA
                $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                $numerodeletras = 7;
                $cadena = "";
                for($i = 0; $i < $numerodeletras; $i++) {
                    $cadena .= substr($caracteres, rand(0, strlen($caracteres) - 1), 1);
                }
                // Almacenar el CAPTCHA en la sesión
                $_SESSION['captcha'] = $cadena;
                ?>

                <div class="group">
                    <label for="captcha" class="label">CAPTCHA:</label>
                    <input type="text" id="captcha" name="captcha" class="input" value="<?php echo $cadena; ?>" readonly>
                </div>

                <div class="group">
                    <label for="captcha_input" class="label">Ingrese el CAPTCHA:</label>
                    <input type="text" id="captcha_input" name="captcha_input" class="input" required>
                </div>

                <div class="group">
                    <button type="submit" class="button">INICIAR SESIÓN</button>
                </div>
            </form>

            <br>
            <a href="recuperar.php" class="olvidar-contrasena">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>
