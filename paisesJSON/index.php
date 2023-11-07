<?php
    $json = file_get_contents("paises.json"); // Accedemos al contenido del archivo json
    $data = json_decode($json, true); // Lo decodificamos y lo convertimos a un array asociativo

    // Creamos una tabla para los nombres de los paises, las capitales y para el link de google maps
    echo "<table border = '1' cellspacing = '0'>";
    echo "<tr>
            <th>Nombre País</th>
            <th>Nombre de la Capital</th>
            <th>Link Google Maps</th>";
    echo "</tr>";
    
    for($i = 1; $i <= 10 ; $i++){
        $paises = $data["pais$i"]; // Guardamos cada dato que se encuentra en pais1, pais2, pais3... en $paises
        // Luego accedemos a las claves que nos mostrarán el contenido de su valor
        echo "<tr>
                <td> {$paises['nombrePais']} </td>
                <td> {$paises['nombreCapital']} </td>
                <td> <a href= '{$paises['googleMaps']}'>{$paises['nombrePais']}</a></td>
            </tr>";
    }
    echo "</table>";
?>