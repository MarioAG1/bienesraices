<?php

//Incluye el header
require "includes/app.php";
//Añadir conexion
$db = conectarDB();

//Autenticar usuario

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //  echo "<pre>";
    //  var_dump($_POST);
    //  echo "</pre>";

    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST["password"]);

    if (!$email) {
        $errores[] = "El email es obligatorio o no es valido";
    }
    if (!$password) {
        $errores[] = "La contraseña es obligatoria";
    }
    if (empty($errores)) {
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $resultado = mysqli_query($db, $query);


        // var_dump($query);

        if ($resultado->num_rows) {
            //Revisar que la contraseña es correcta
            $usuario = mysqli_fetch_assoc($resultado);

            //Verificar la contraseña
            $auth = password_verify($password, $usuario["password"]);

            if ($auth) {
                //El usuario ha sido authenticado
                session_start();

                //Llenar el arreglo de la sesion
                $_SESSION["usuario"] = $usuario["email"];
                $_SESSION["login"] = true;

                header("Location:/admin");
                
            } else {
                $errores[] = "La contraseña es incorrecta";
            }
        } else {
            $errores[] = "El usuario no existe";
        }
    }
}


incluirTemplate("header");
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Email y Password</legend>
            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email" require>
            <label for="password">Contraseña</label>
            <input type="password" name="password" placeholder="Tu Contraseña" id="contraseña" require>
        </fieldset>
        <input type="submit" value="Iniciar sesion" class="boton-verde">
    </form>
</main>

<?php
incluirTemplate("footer");
?>