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
        input{
            text-align:center;
        }
    </style>
</head>
<body>
    <form method= "POST">
        <fieldset>
            <legend>Registro Usuario</legend>
            <label for="name">Nombre: </label><br>
            <input type= "text" placeholder= "Introduzca su nombre de pila" id= "name" name= "nombre" required><br>
            
            <label for="apellido">Apellido: </label><br>
            <input type= "text" placeholder= "Introduzca su apellido" id= "apellido" name= "apellido" required><br>
            
            <label for="name">Nombre Usuario: </label><br>
            <input type= "text" placeholder= "Introduzca nombre de usuario" id= "name" name= "usuario" required><br>

            <label for="pass">Contraseña: </label><br>
            <input type= "password" placeholder= "Introduzca contraseña" id= "pass" name= "passwd" minlength ="5" required><br>
            <?php
                if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['passwd'])){
                    // Vamos a guardar nuestras credenciales en una variable
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $usuario = $_POST['usuario'];
                    $passwd = $_POST['passwd'];
                    $password_hash = password_hash($passwd, PASSWORD_BCRYPT); // En esta parte crearemos una contraseña con hash y la guardamos 

                    $openR = fopen("usuarios.csv", "r");
                    $header = fgetcsv($openR, 1000, ";"); // Luego guardamos los títulos de nuestro archivo

                    $usName;

                    // Recorremos todos los datos que hayan en nuestro registro de usuarios y guardamos todos
                    while($datos = fgetcsv($openR, 1000, ";")){
                        $us = $datos[array_search('users', $header)];
                        if($us == $usuario){
                            $usName = $usuario;
                            $mensaje_error = "El usuario ya existe, intenta otro";
                            break;
                        }
                    }
                    fclose($openR);

                    $openW = fopen("usuarios.csv", "a"); // Vamos a abrir el fichero, en el que vamos a escribir nuestras credenciales

                    // En caso de que no haya ningun mensaje de error, procederemos a guardar las creedenciales del usuario
                    if(!isset($mensaje_error)){
                        $creedenciales = [$nombre, $apellido, $usuario, $password_hash]; // Guardamos todas las creedenciales en un array.
                        fputcsv($openW, $creedenciales, ";"); // Y ahora introducimos los datos en un nuestro archivo .csv
                        fclose($openW);
                        header("Location: index.php");
                        exit();
                    }
                }
            ?>
            <div> 
                <?php 
                    if(isset($mensaje_error)){
                        echo 
                            "<script type = 'text/javascript'>
                                alert('$mensaje_error');
                            </script>"; 
                    } 
                ?> 
            </div>
            <input type="submit" value="Registrarse" class ="boton"><br> 
        </fieldset>
    </form>
</body>
</html>