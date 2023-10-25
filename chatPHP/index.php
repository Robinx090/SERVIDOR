<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        fieldset{
            display: flex;
            flex-direction: column;
            text-align: center;
            width: 15em;
            margin: auto;
        }
        legend{
            font-size: 2em;
        }
        .boton{
            height: 3em;
        }
        .noCliente{
            text-align: left;
        }
        input{
            text-align:center;
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Iniciamos una sesión

        if(isset($_POST['usuario']) && isset ($_POST['passwd']) ){
            $user = $_POST['usuario']; // Guardamos el nombre del usuario
            $password = $_POST['passwd']; // Guardamos la contraseña del usuario. TODO: No tenemos que guardar la contraseña en sí, sino su cifrado

            $openFile_Users = fopen("usuarios.csv", "r");    // Lo primero que vamos a hacer será abrir el fichero
            $headers = fgetcsv($openFile_Users, 1000, ";"); // Ahora guardamos los nombres de las cabeceras, para poder buscar por el título posteriormente
    
            $bool = false; // Vamos a crear una variable que va a actuar como un booleano
    
            // Mientras haya datos, entonces seguirá ejecutandose
            while($datos = fgetcsv($openFile_Users, 1000, ";")){
                // Guardamos los datos de la columna 'users' y contraseña
                $datosUsers = $datos[array_search('users', $headers)];
                $password_hash = $datos[array_search('password', $headers)];
                
                /* En el caso de que el usuario coincida con el de nuestro registro, crearemos otra condición, la cual verficará si nuestra contraseña es igual a la del hash*/
                if ($user == $datosUsers && password_verify($password, $password_hash)) {
                    // Contraseña correcta, usuario autenticado
                    $_SESSION['usuario'] = $user;
                    header("Location: chatPHP.php");
                    exit();
                }
            }

            if($bool == false){
                echo 
                    "<script type='text/javascript'>
                        alert('Las creedenciales son incorrectas, si no dispone de una cuenta, puede hacerse una rápidamente');
                    </script>";
            }
        }
    ?>
    <form method= "POST">
        <fieldset>
            <legend>Login</legend>
            <label for="name">Usuario: </label><br>
            <input type= "text" placeholder= "Introduzca nombre de usuario" id= "name" name="usuario" required><br>

            <label for="pass">Contraseña: </label><br>
            <input type= "password" placeholder= "Introduzca contraseña" id= "pass" name="passwd" required><br>

            <input type="submit" value="Entrar" class ="boton"><br>

            <a href="registro.php" class="noCliente">¿No tienes cuenta?</a>
        </fieldset>
    </form>
</body>
</html>