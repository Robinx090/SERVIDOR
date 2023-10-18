<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Vamos a abrir el archivo csv
        $oFile = fopen("horario.csv", "r");
        $contador = 0;

        $header = fgetcsv($oFile, 1000, ";");

        echo 
            "<table border = '3' style = 'border-collapse: collapse; text-align: center;'>
                <tr>
                    <th>Nombre Estación</th>
                    <th>Nombre Magnitud</th>"; 
                for($i = 0; $i < 24; $i++){
                    echo "<th>h$i</th>";
                }
        echo           
            "</tr>
            ";

        while (($datosEstacion = fgetcsv($oFile,1000, ";")) && ($contador < 5)){
            $nombreEstacion = "";
            
            if($datosEstacion[2] == 4){
                $nombreEstacion = "Pza de España";
            }

            $nombreMagnitud = "";

            switch($datosEstacion[3]){
                case 1:
                    $nombreMagnitud = "Dióxido de azufre";
                    break;
                case 6:
                    $nombreMagnitud = "Monóxido de Carbono";
                    break;
                case 7:
                    $nombreMagnitud = "Monóxido de Nitrógeno";
                    break;
                case 8:
                    $nombreMagnitud = "Dióxido de Nitrógeno";
                    break;
                case 12:
                    $nombreMagnitud = "Óxidos de Nitrógeno";
                    break;
            }

            echo 
                "<tr>
                    <td>$nombreEstacion</td>
                    <td>$nombreMagnitud</td>";
                
            for($i = 8; $i < count($datosEstacion); $i+=2){
                echo 
                    "<td>$datosEstacion[$i]</td>";
            }

            echo "</tr>";
            $contador ++;
        }
        echo "</table>";
        fclose($oFile);
    ?>
</body>
</html>