<?php
    try {
        $config = parse_ini_file('../../private/config.ini'); // Accedemos a la configuración que tenemos creado dentro de nuestra carpeta private
        $server_bbdd = "mysql:host={$config['server_name']};dbname={$config['db_name']}"; // Introducimos los datos del servidor y la base de datos, que se encuentran dentro de nuestra configuración
        $conn = new PDO($server_bbdd, $config['user'], $config['passwd']); // Metemos el usuario y contraseña que nos falta de añadir en la instancia de PDO

        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejamos las excepciones
    
        // Hacemos una comprobación para comprobar si nuestro archivo existe
        $csv = "../../private/csv/importacion.csv";
        if(file_exists($csv)){
            $fopen = fopen($csv, 'r');
            $header = fgetcsv($fopen); // Guardamos la primera línea, que en nuestro caso es un header

            while($data = fgetcsv($fopen, 1000, ",")){
                $insert = "INSERT INTO DatosAlumnos (" . implode(',', $header) . ") VALUES ('" . implode("','", $data) . "')";
                $conn->exec($insert);
            }
            fclose($fopen);
            echo "Importación éxitosa";
        }else{
            echo "El archivo CSV no existe";
        }
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
?>