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
            "28079017" => "Villaverde Alto"
        );
        $magnitudes = array(
            "1" => "Dióxido de Azufre SO2",
            "6" => "Monóxido de Carbono CO",
            "7" => "Monóxido de Nitrógeno NO",
            "8" => "Dióxido de Nitrógeno NO2",
            "9" => "Partículas < 2.5 µm PM2.5"
        );

        echo 
            "<table border = '3' style = 'border-collapse: collapse; text-align: center;'>
                <tr>
                    <th>$header[2]</th>
                    <th>$header[3]</th>"; 
                for($i = 8; $i < count($header); $i += 2){
                    echo "<th>$header[$i]</th>";
                }
        echo "</tr>";

        while (($datosEstacion = fgetcsv($oFile,1000, ";")) ){

            $puntosMuestreo = $datosEstacion[4]; // Guardamos los puntos de muestreo para poder mostrar el nombre de la estación
            $cod_Magnitud = $datosEstacion[3];
            // De esta manaera obviamos las barra baja de los puntos de muestreo que no nos hace falta, ya que en el array lo tenemos sin eso
            // *Cabe destacar que $codMuestreo guardará el valor como si fuera un array y en la posición 0 se sobreescribirá en cada iteracción
            $codMuestreo = explode("_", $puntosMuestreo);

            // Y ahora en cada interacción del bucle guardamos lo que haya guardado en la posición 0
            $cod_Estacion = $codMuestreo[0]; 

            $nombreMagnitud = "";

            if(array_key_exists($cod_Estacion, $estaciones) && array_key_exists($cod_Magnitud, $magnitudes) ){
    
                echo 
                    "<tr>
                        <td>$estaciones[$cod_Estacion]</td>
                        <td>$magnitudes[$cod_Magnitud]</td>";
                    
                for($i = 8; $i < count($datosEstacion); $i+=2){
                    echo 
                        "<td>$datosEstacion[$i]</td>";
                }
    
                echo "</tr>";
            }
            
        }
        echo "</table>";
        fclose($oFile);
    ?>
</body>
</html>