<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Definición de variables y mensajes de error
    $name = $phone = $email = "";
    $nameErr = $phoneErr = $emailErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 1. Validación del nombre
        if (empty($_POST["name"])) {
            $nameErr = "<br><i>El nombre es obligatorio.";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]*$/", $name)) { //Dejo minúsculas y mayúsculas, vocales acentuadas ñ y espacio en blanco
                $nameErr = "<br><i>El nombre solo debe contener letras y espacios.";
            }
        }

        // 2. Validación del teléfono
        if (empty($_POST["phone"])) {
            $phoneErr = "<br><i>El teléfono es obligatorio.";
        } else {
            $phone = test_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{9}$/", $phone)) { //9 dígitos numéricos
                $phoneErr = "<br><i>El teléfono debe contener exactamente 9 números.";
            }
        }

        // 3. Validación del correo electrónico
        if (empty($_POST["email"])) {
            $emailErr = "<br><i>El correo es obligatorio.";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "<br><i>El formato del correo es inválido.";
            }
        }

        // 4. Mostrar datos si no hay errores
        if (empty($nameErr) && empty($phoneErr) && empty($emailErr)) {
            echo "<h2>Datos válidos ingresados:</h2>";
            echo "<p>Nombre: $name</p>";
            echo "<p>Teléfono: $phone</p>";
            echo "<p>Correo: $email</p>";
        }
    }

    // Función para limpiar y procesar datos
    function test_input($data)
    {
        $data = trim($data); //Quitamos los espacio en blanco
        $data = stripslashes($data); // Elimina las barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML

        return $data; //Devolvemos el string "limpito"
    }
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Formulario de Validación</title>
        <link rel="stylesheet" href="../../css/estilos.css">
    </head>

    <body>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2>Datos de Amigos</h2>
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>">
            <!--El echo name es para  que siga mostrando los datos aun despues de haber enviado 
            el formulario-->
            <span style="color:red"><?php echo $nameErr; ?></span><br><br>

            <label for="phone">Teléfono:</label><br>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
            <span style="color:red"><?php echo $phoneErr; ?></span><br><br>

            <label for="email">Correo:</label><br>
            <input type="text" id="email" name="email" value="<?php echo $email; ?>">
            <span style="color:red"><?php echo $emailErr; ?></span><br><br>

            <button>Enviar</button>
        </form>
    </body>

    </html>
</body>

</html>