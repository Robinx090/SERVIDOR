<?php
// Haya una página para listar todos los alumnos
    try{
        $config = parse_ini_file('../../private/config.ini'); // Accedemos a la configuración que tenemos creado dentro de nuestra carpeta private
        $server_bbdd = "mysql:host={$config['server_name']};dbname={$config['db_name']}"; // Introducimos los datos del servidor y la base de datos, que se encuentran dentro de nuestra configuración
        $conn = new PDO($server_bbdd, $config['user'], $config['passwd']); // Metemos el usuario y contraseña que nos falta de añadir en la instancia de PDO

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ahora haremos un select, para que nos muestre todos los datos de nuestra tabla, en este caso 'DatosAlumnos'
        $stmt = $conn->prepare("SELECT * FROM DatosAlumnos");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Guardamos los resultados como un array asociativo

        // Comprobaremos si hay algún datos antes de mostrar el listado
        if($result){
            echo "<h3>Lista de Alumnos</h3>";
            echo "<ol>";
            foreach($result as $fila){
                echo "<li><b>Nombre:</b> " . $fila['nombre'] . ", <b>Apellido:</b> " . $fila['apellido'] ."</li>";
            }
            echo "</ol>";
        }else{
            echo "<p>Actualmente no hay alumnos registrados</p>";
        }
        
    }catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
?>
