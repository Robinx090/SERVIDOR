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

        $header = fgetcsv($oFile, 1000, ";");// Guardamos los datos de la cabecera

        // Hacemos un array de los nombres de las estaciones
        $estaciones = array(
                "28079001" => "Pº. Recoletos Baja",
                "28079002" => "Glta. de Carlos V Baja",
                "28079003" => "Pza. del Carmen",
                "28079004" => "Pza. de España",
                "28079005" => "Barrio del Pilar",
                "28079006" => "Pza. Dr. Marañón Baja",
                "28079007" => "Pza. M. de Salamanca Baja",
                "28079008" => "Escuelas Aguirre",
                "28079009" => "Pza. Luca de Tena Baja",
                "28079010" => "Cuatro Caminos",
                "28079011" => "Av. Ramón y Cajal",
                "28079012" => "Pza. Manuel Becerra Baja",
                "28079013" => "Vallecas",
                "28079014" => "Pza. Fdez. Ladreda Baja",
                "28079015" => "Pza. Castilla Baja",
                "28079016" => "Arturo Soria",
                "28079017" => "Villaverde Alto",
                "28079018" => "C/ Farolillo",
                "28079019" => "Huerta Castañeda Baja",
                "28079020" => "Moratalaz",
                "28079021" => "Pza. Cristo Rey Baja",
                "28079022" => "Pº. Pontones Baja",
                "28079023" => "Final C/ Alcalá Baja",
                "28079024" => "Casa de Campo",
                "28079025" => "Santa Eugenia Baja",
                "28079026" => "Urb. Embajada (Barajas) Baja",
                "28079027" => "Barajas",
                "28079047" => "Méndez Álvaro Alta",
                "28079048" => "Pº. Castellana Alta",
                "28079049" => "Retiro Alta",
                "28079050" => "Pza. Castilla Alta",
                "28079054" => "Ensanche Vallecas Alta",
                "28079055" => "Urb. Embajada (Barajas) Alta",
                "28079056" => "Plaza Elíptica Alta",
                "28079057" => "Sanchinarro Alta",
                "28079058" => "El Pardo Alta",
                "28079059" => "Parque Juan Carlos I Alta",
                "28079060" => "Tres Olivos Alta"
            );

        

        echo 
            "<table border = '3' style = 'border-collapse: collapse; text-align: center;'>
                <tr>
                    <th>$header[2]</th>
                    <th>$header[3]</th>"; 
                for($i = 0; $i < 24; $i++){
                    echo "<th>$header[$i]</th>";
                }
        echo "</tr>";

        while (($datosEstacion = fgetcsv($oFile,1000, ";")) && ($contador < 5)){

            $puntosMuestreo = $datosEstacion[4]; // Guardamos los puntos de muestreo para poder mostrar el nombre de la estación
            
            // De esta manaera obviamos las barra baja de los puntos de muestreo que no nos hace falta, ya que en el array lo tenemos sin eso
            // *Cabe destacar que $codMuestreo guardará el valor como si fuera un array y en la posición 0 se sobreescribirá en cada iteracción
            $codMuestreo = explode("_", $puntosMuestreo);

            // Y ahora en cada interacción del bucle guardamos lo que haya guardado en la posición 0
            $codEstacion = $codMuestreo[0]; 

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
                    <td>$estaciones[$codEstacion]</td>
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