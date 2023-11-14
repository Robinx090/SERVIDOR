<?php
    try {
        $config = parse_ini_file('../../private/config.ini'); // Accedemos a la configuración que tenemos creado dentro de nuestra carpeta private
        $server_bbdd = "mysql:host={$config['server_name']};dbname={$config['db_name']}"; // Introducimos los datos del servidor y la base de datos, que se encuentran dentro de nuestra configuración
        $conn = new PDO($server_bbdd, $config['user'], $config['passwd']); // Metemos el usuario y contraseña que nos falta de añadir en la instancia de PDO
        
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Manejamos las excepciones
        $stmt = $conn->prepare("SELECT * FROM DatosAlumnos"); // Establecemos nuestra consulta para obtener todos los datos de nuestra tabla
        $stmt-> execute(); // Ejecuutamos nuestra consulta
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Guardamos los resultados como un array asociativo

        // Ahora que ya obtenemos todos los datos en la variable $result, vamos a crear nuestro archivo csv, en dónde exportaremos nuestro SQL
        $csv = "../../private/csv/exportacion_MSQL.csv";
        $fopen = fopen($csv, "w");
        fputcsv($fopen, array_keys($result[0])); // Introducimos en nuestro fichero todos los datos de la cabecera de nuestro SQL

        // Recorremos y vamos guardando cada datos que se encuentra en 'result' en 'data'
        foreach($result as $data){
            fputcsv($fopen, $data);
        }

        fclose($fopen);

        echo "<a href='$csv' download>Pulse para exportar el fichero MSQL a CSV</a>";
    } catch (PDOException $e) {
        echo "Error" . $e->getMessage();
    }
?>