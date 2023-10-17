<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $open = fopen("AccidentesBicicletas_2023.csv", "r");
        $headers = fgetcsv($open, 1000, ";"); //Guardamos los encabezados

        echo 
            "<table border = '1px'; style = 'margin: auto;'>
            <tr>
                <th>Fecha</th>
                <th>Lesividad</th>
                <th>Tipo de Vehículo</th>
            </tr>";

        while($datos = fgetcsv($open, 1000, ";")){
            $fecha = $datos[array_search('fecha', $headers)];
            $lesividad = $datos[array_search('lesividad', $headers)];
            $tipo_vehiculo = $datos[array_search('tipo_vehiculo', $headers)];
            echo 
                "<tr>
                    <td>$fecha</td>
                    <td>$lesividad</td>
                    <td>$tipo_vehiculo</td>
                </tr>";
        }
        echo "</table>";
        fclose($open);
    ?>
</body>
</html>