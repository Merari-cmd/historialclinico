
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" type="text/css" href="estilos.css"> 
</head>
<body>
    <div class="login-wrap">
        <div class="login-html">
            <h1>Restablecer Contraseña</h1>
            <form action="validarecuperar.php" method="post" class="login-form">
                <div class="group">
                    <label for="email" class="label">Email:</label>
                    <input type="email" id="email" name="email" class="input" required>
                </div>

                <div class="group">
                    <label for="pregunta" class="label">Pregunta secreta:</label>
                    <select id="pregunta" name="pregunta" class="input" required>
                        <option value="color">¿Cuál es tu color favorito?</option>
                        <option value="animal">¿Cuál es tu animal favorito?</option>
                        <option value="mascota">¿Cómo se llama tu mascota?</option>
                    </select>
                </div>

                <div class="group">
                    <label for="respuesta" class="label">Respuesta a la Pregunta:</label>
                    <input type="text" id="respuesta" name="respuesta" class="input" required>
                </div>

                <div class="group">
                    <label for="nueva_contrasena" class="label">Nueva Contraseña:</label>
                    <input type="password" id="nueva_contrasena" name="nueva_contrasena" class="input" required>
                </div>

                <div class="group">
                    <label for="confirmar_contrasena" class="label">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" class="input" required>
                </div>

                <div class="group">
                    <button type="submit" class="button">RESTABLECER</button>
                </div>
            </form>
            <br>
              <button class="button" onclick="location.href='cerrar.php'">Salir</button>
            <a href="index.php" class="foot-lnk">Volver a Inicio de Sesión</a>
            
        </div>
    </div>
</body>
</html>
