<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        fieldset{
            font-size: larger;
            width: fit-content;
            margin: auto;
        }
    </style>
</head>
<body>
    <form method='post'>
        <fieldset>
            <legend>Insertar alumnos</legend>
            <label for="nombre">Nombre: </label><br>
            <input type="text" name ='nombre' id='nombre' placeholder='Introduzca nombre' require><br>

            <label for="apellido">Apellido: </label><br>
            <input type="text" name ='apellido' id='apellido' placeholder='Introduzca apellido' require>

            <br><br>
            <input type="submit" value="Insertar">
            <a href="listar.php">Listar</a>
            <a href="buscar.php">Buscar</a>
        </fieldset>
    </form>
</body>
</html>

<?php
    //1-Haya una página para insertar alumnos(nombre y apellido).

    // Lo primero que haremos será comprobar si el usuario a puesto nombre y apellido en el formulario
    if( isset($_POST['nombre']) && isset($_POST['apellido']) ){
        // Ahora guardaremos el nombre y apellido que haya puesto el usuario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        // Intentamos ejecutar el código, en caso de error se irá al bloque catch
        try{
            $config = parse_ini_file('../../private/config.ini'); // Accedemos a la configuración que tenemos creado dentro de nuestra carpeta private
            $server_bbdd = "mysql:host={$config['server_name']};dbname={$config['db_name']}"; // Introducimos los datos del servidor y la base de datos, que se encuentran dentro de nuestra configuración
            $conn = new PDO($server_bbdd, $config['user'], $config['passwd']); // Metemos el usuario y contraseña que nos falta de añadir en la instancia de PDO

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Nos permite configurar el manejo de errores
            
            // Procedemos a crear nuestra tabla en caso de que no exista
            $sql = "CREATE TABLE IF NOT EXISTS DatosAlumnos(
                id int(4) AUTO_INCREMENT PRIMARY KEY,
                nombre VARCHAR(50) NOT NULL,
                apellido VARCHAR(50) NOT NULL
            )";

            $conn->exec($sql); // Ejecutamos nuestro sql, que en este caso creará una tabla en caso de que no exista

            $conn->exec("USE {$config['db_name']}"); // Seleccionamos la misma base de datos, para poder introducir datos
            $sql_Insert = "INSERT INTO DatosAlumnos(nombre, apellido)
                        VALUES('$nombre', '$apellido')";
            $conn->exec($sql_Insert); // Ejecutamos nuestro script, que en este camos introduciremos los datos que el usuario nos a proporcionado
            echo "<p>El alumno fue introducido éxitosamente</p>";
        }catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage(); // Nos devolverá un mensaje de error hacía nuestra base de datos
        }
    } 
?>