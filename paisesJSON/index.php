<?php
    $json = file_get_contents("https://restcountries.com/v3.1/all"); // Accedemos al contenido del archivo json
    $data = json_decode($json); // Lo decodificamos

    // Creamos una tabla para los nombres de los paises, las capitales y para el link de google maps
    echo "<table border = '1' cellspacing = '0'>";
    echo "<tr>
            <th>Nombre País</th>
            <th>Nombre de la Capital</th>
            <th>Link Google Maps</th>";
    echo "</tr>";

    for($i = 0; $i < count($data) ; $i++){
        // Luego accedemos a las claves que nos mostrarán el contenido de su valor
        echo "<tr>";
        // Pondremos está condición para que en el caso de que el nombre de la capital no se encuentre en la posición 0
            if(isset($data[$i]->capital[0])){
                echo "<td> {$data[$i]->name->common} </td>
                <td> {$data[$i]->capital[0]} </td>
                <td> <a href= '{$data[$i]->maps->googleMaps}'>{$data[$i]->name->common}</a></td>";
            }
        echo "</tr>";
    }
    echo "</table>";
?>