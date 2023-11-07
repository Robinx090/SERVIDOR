<?php
    $file = fopen("agenda.csv", 'r'); // Abrimos el archivo, para que sea modo lectura
    $header = fgetcsv($file);
    $data = array();
    
    while ( $row = fgetcsv($file) ) {
        $data[] = array_combine($header, $row); // Procedemos a guardar un array con los datos de la cabecera y los datos del nuestro archivo .csv
    }
    fclose($file);
    
    $json = json_encode($data, JSON_PRETTY_PRINT); // Convierte el array asociativo en formato JSON con formato legible
    
    $archivoJSON = 'archivo.json';
    
    // Guardamos los datos que se encuentra en la variable $json y los trasladamos a un archivo json que se generará en cuánto accedamos a esta pagina
    file_put_contents($archivoJSON, $json);
    
    // Establecemos la cabecera de la respuesta HTTP para indicar que el contenido es de tipo JSON
    header('Content-Type: application/json');
    
    // Muestra el JSON en la página web
    echo $json;
?>
