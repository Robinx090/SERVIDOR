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
        echo 
            "<table border = '3' style = 'border-collapse: collapse; text-align: center;'>";

        while (($datosEstacion = fgetcsv($oFile,1000, ";")) && ($contador <= 5)){

            echo 
                "<tr>
                    <td>$datosEstacion[2]</td>
                    <td>$datosEstacion[3]</td>";
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