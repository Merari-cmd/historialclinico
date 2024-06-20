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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
    <style>
/* styles.css */

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
<?php

require_once 'concexion.php'; // Incluye el archivo de conexión a la base de datos

if (!isset($_SESSION['email'])) {
    exit();
}

// Consulta SQL para recuperar datos del usuario con el email
$query = "SELECT nombre, apaterno, amaterno, sexo, edad, tel, email, sucursal_id, 
          glucosa, urea, trigliceridos, creatinina, acido, colesterol, ldl, hdl 
          FROM pacientes 
          WHERE email = :email";

$stmt = $pdo->prepare($query);
$stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<h2>Usuario no encontrado</h2>";
    exit();
}

// Verificar posibles errores en los resultados de validación y registro
if (!empty($_SESSION['resultados']['errores'])) {
    echo "<h2>Errores:</h2>";
    foreach ($_SESSION['resultados']['errores'] AS $error) {
        echo "<p>$error</p>";
    }
}

$glucosa = $usuario['glucosa']; // Obtén el valor de glucosa
$acido = $usuario['acido']; // Obtén el valor del ácido úrico
$urea = $usuario['urea']; // Obtén el valor de la urea
$trigliceridos = $usuario['trigliceridos']; // Obtén el valor de triglicéridos
$creatinina = $usuario['creatinina']; // Obtén el valor de la creatinina
$sexo = $usuario['sexo'];
$edad = $usuario['edad'];
$colesterol = $usuario['colesterol'];
$ldl = $usuario['ldl'];
$hdl = $usuario['hdl'];

// Mensajes de estado de glucosa
$mensaje_glucosa = "";
if ($glucosa < 70) {
    $mensaje_glucosa = "Hipoglucemia: El nivel de glucosa es menor a 70 mg/dL, por dieta o reacción a la insulina";
} elseif ($glucosa > 110) {
    $mensaje_glucosa = "Posibilidad de diabetes: El nivel de glucosa es mayor a 110 mg/dL.";
} else {
    $mensaje_glucosa = "Nivel de glucosa normal: El nivel de glucosa se encuentra en el rango de 70 a 110 mg/dL.";
}

// Mensajes de estado de ácido úrico
$mensaje_acido = "";
if ($acido < 2) {
    $mensaje_acido = "Hipouricemia: El nivel de ácido úrico es menor a 2 mg/dl.";
} elseif ($acido > 6 && $acido <= 8) {
    $mensaje_acido = "Valor alto: El nivel de ácido úrico está en el rango de 6 a 8 mg/dl, lo que puede requerir una dieta restrictiva.";
} elseif ($acido > 8 && $acido <= 12) {
    $mensaje_acido = "Valor alto: El nivel de ácido úrico está por encima de 8 mg/dl, lo que puede causar dolor de gota y enfermedades renales.";
} elseif ($acido > 12) {
    $mensaje_acido = "Valor muy alto: El nivel de ácido úrico supera 12 mg/dl, lo que indica una enfermedad renal o dolor de gota severo.";
} elseif ($edad >= 6 && $edad <= 12) {
    if ($sexo == 'Femenino') {
        $mensaje_acido = "Nivel de ácido úrico normal para niñas: El nivel de ácido úrico se encuentra entre 2.5 y 6 mg/dl para niñas de 6 a 12 años.";
    } else {
        $mensaje_acido = "Nivel de ácido úrico normal para niños: El nivel de ácido úrico se encuentra entre 2.5 y 5 mg/dl para niños de 6 a 12 años.";
    }
} else {
    if ($sexo == 'Femenino') {
        $mensaje_acido = "Nivel de ácido úrico normal para mujeres: El nivel de ácido úrico está en el rango de 2.5 a 6 mg/dl.";
    } elseif ($sexo == 'Masculino') {
        $mensaje_acido = "Nivel de ácido úrico normal para hombres: El nivel de ácido úrico está en el rango de 4.5 a 8 mg/dl.";
    } else {
        $mensaje_acido = "Nivel de ácido úrico normal: El nivel de ácido úrico está en el rango de 2.5 a 6 mg/dl para mujeres y 4.5 a 8 mg/dl para hombres.";
    }
}

// Mensaje de urea
$mensaje_urea = "";
if ($urea < 40) {
    $mensaje_urea = "Urea normal: Menos de 40 mg/dL.";
} else {
    $mensaje_urea = "Urea alta: Mayor a 40 mg/dL – posible falla renal.";
}

// Mensaje de triglicéridos
$mensaje_trigliceridos = "";
if ($trigliceridos < 100) {
    $mensaje_trigliceridos = "Triglicéridos normales: Menos de 100 mg/dL.";
} else {
    $mensaje_trigliceridos = "Triglicéridos altos: Mayor a 100 mg/dL – posible riesgo cardiovascular.";
}

// Mensaje de creatinina
$mensaje_creatinina = "";
if ($sexo == 'Femenino') {
    if ($creatinina < 0.96) {
        $mensaje_creatinina = "Creatinina normal: Menos de 0.96 mg/dL.";
    } elseif ($creatinina > 1) {
        $mensaje_creatinina = "Creatinina alta: Mayor a 1 mg/dL – posible falla renal.";
    }
} elseif ($sexo == 'Masculino') {
    if ($creatinina < 1.3) {
        $mensaje_creatinina = "Creatinina normal: Menos de 1.3 mg/dL.";
    } elseif ($creatinina > 1.5) {
        $mensaje_creatinina = "Creatinina alta: Mayor a 1.5 mg/dL – posible falla renal.";
    }
}

// Mensaje de colesterol
$mensaje_colesterol = "";
if ($colesterol < 200) {
    $mensaje_colesterol = "Colesterol Total normal: Menos de 200 mg/dL.";
} else {
    $mensaje_colesterol = "Colesterol Total alto: Mayor a 200 mg/dL – Esto puede ser un factor de riesgo cardiovascular.";
}

// Mensaje de HDL (Colesterol "bueno")
$mensaje_hdl = "";
if ($hdl >= 40) {
    $mensaje_hdl = "Nivel saludable de HDL: Mayor o igual a 40 mg/dL.";
} else {
    $mensaje_hdl = "Nivel bajo de HDL: Menor a 40 mg/dL. Esto puede ser un factor de riesgo cardiovascular.";
}

// Mensaje de LDL (Colesterol "malo")
$mensaje_ldl = "";
if ($sexo == 'Femenino') {
    if ($ldl < 70) {
        $mensaje_ldl = "Nivel saludable de LDL: Menos de 70 mg/dL.";
    } else {
        $mensaje_ldl = "Nivel alto de LDL: Mayor a 70 mg/dL – Esto puede ser un factor de riesgo cardiovascular.";
    }
} elseif ($sexo == 'Masculino') {
    if ($ldl < 130) {
        $mensaje_ldl = "Nivel saludable de LDL: Menos de 130 mg/dL.";
    } else {
        $mensaje_ldl = "Nivel alto de LDL: Mayor a 130 mg/dL – Esto puede ser un factor de riesgo cardiovascular.";
    }
}

// Mostrar el mensaje según el sexo del usuario
$mensaje_sexo = "";
if ($sexo == 'Femenino') {
    $mensaje_sexo = "Es mujer";
} elseif ($sexo == 'Masculino') {
    if ($edad >= 6 && $edad <= 12) {
        $mensaje_sexo = "Es niño";
    } else {
        $mensaje_sexo = "Es hombre";
    }
} else {
    $mensaje_sexo = "Es niño";
}

// Mostrar datos personales y médicos
echo "<h1>Resultados </h1>";
echo "<h2>Datos Personales</h2>";
echo "<p>Nombre: {$usuario['nombre']} {$usuario['apaterno']} {$usuario['amaterno']}</p>";
echo "<p>Sexo: $mensaje_sexo</p>";
echo "<p>Edad: {$usuario['edad']}</p>";
echo "<p>Teléfono: {$usuario['tel']}</p>";
echo "<p>Email: {$usuario['email']}</p>";
echo "<p>Sucursal: {$usuario['sucursal_id']}</p>";

echo "<h2>Datos Médicos</h2>";
echo "<p>Glucosa (mg/dL): $glucosa</p>";
echo "<p>Urea (mg/dL): $urea</p>";
echo "<p>Triglicéridos (mg/dL): $trigliceridos</p>";
echo "<p>Creatinina (mg/dL): $creatinina</p>";
echo "<p>Ácido Úrico (mg/dL): $acido</p>";
echo "<p>Colesterol Total (mg/dL): $colesterol</p>";
echo "<p>LDL (mg/dL): $ldl</p>";
echo "<p>HDL (mg/dL): $hdl</p>";

// Mostrar mensaje sobre glucosa, ácido úrico, urea y triglicéridos
echo "<h2>Estado de los Niveles Médicos</h2>";
echo "<p>$mensaje_glucosa</p>";
echo "<p>$mensaje_acido</p>";
echo "<p>$mensaje_urea</p>";
echo "<p>$mensaje_trigliceridos</p>";
echo "<p>$mensaje_creatinina</p>";
echo "<p>$mensaje_colesterol</p>";
echo "<p>$mensaje_ldl</p>";
echo "<p>$mensaje_hdl</p>";

// Contar parámetros altos y bajos
$parametros_altos = 0;
$parametros_bajos = 0;
$lista_altos = [];
$lista_bajos = [];

if ($glucosa < 70 || $glucosa > 110) {
    if ($glucosa < 70) {
        $parametros_bajos++;
        $lista_bajos[] = "Glucosa";
    }
    if ($glucosa > 110) {
        $parametros_altos++;
        $lista_altos[] = "Glucosa";
    }
}
if ($acido < 2 || $acido > 6) {
    if ($acido < 2) {
        $parametros_bajos++;
        $lista_bajos[] = "Ácido Úrico";
    }
    if ($acido > 6) {
        $parametros_altos++;
        $lista_altos[] = "Ácido Úrico";
    }
}
if ($urea >= 40) {
    $parametros_altos++;
    $lista_altos[] = "Urea";
}
if ($trigliceridos >= 100) {
    $parametros_altos++;
    $lista_altos[] = "Triglicéridos";
}
if (($sexo == 'Femenino' && ($creatinina < 0.96 || $creatinina > 1)) || ($sexo == 'Masculino' && ($creatinina < 1.3 || $creatinina > 1.5))) {
    if ($creatinina < 0.96 && $sexo == 'Femenino') {
        $parametros_bajos++;
        $lista_bajos[] = "Creatinina";
    }
    if ($creatinina > 1 && $sexo == 'Femenino') {
        $parametros_altos++;
        $lista_altos[] = "Creatinina";
    }
    if ($creatinina < 1.3 && $sexo == 'Masculino') {
        $parametros_bajos++;
        $lista_bajos[] = "Creatinina";
    }
    if ($creatinina > 1.5 && $sexo == 'Masculino') {
        $parametros_altos++;
        $lista_altos[] = "Creatinina";
    }
}
if ($colesterol >= 200) {
    $parametros_altos++;
    $lista_altos[] = "Colesterol Total";
}
if ($hdl < 40) {
    $parametros_bajos++;
    $lista_bajos[] = "HDL";
}
if (($sexo == 'Femenino' && $ldl >= 70) || ($sexo == 'Masculino' && $ldl >= 130)) {
    if ($sexo == 'Femenino' && $ldl >= 70) {
        $parametros_altos++;
        $lista_altos[] = "LDL";
    }
    if ($sexo == 'Masculino' && $ldl >= 130) {
        $parametros_altos++;
        $lista_altos[] = "LDL";
    }
}

// Determinar la acción basada en los parámetros altos y bajos
echo "<h2>Recomendación</h2>";
if ($parametros_altos >= 3) {
    echo "<p>Parámetros altos: " . implode(", ", $lista_altos) . "</p>";
    echo "<p>Mandar al paciente a una visita al doctor con urgencia.</p>";
}
if ($parametros_bajos >= 3) {
    echo "<p>Parámetros bajos: " . implode(", ", $lista_bajos) . "</p>";
    echo "<p>Mandar al paciente a hospitalización.</p>";
}
if ($parametros_altos < 3 && $parametros_bajos < 3) {
    echo "<p>Siga así, tiene menos de 3 parametros bajos y menos de 3 altos.</p>";
}
?>
</body>
</html>