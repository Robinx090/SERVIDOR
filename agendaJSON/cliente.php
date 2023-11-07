<?php
$json = file_get_contents("archivo.json"); // Accedemos al archivo JSON
$data = json_decode($json, true); // Con el valor 'true', lo convertimos a un array asociativo

echo "<table border = '2' cellspacing= '0'>";

foreach ($data as $entry) {
    echo 
        "<tr>
            <td>{$entry['Nombre']}</td>
            <td>{$entry['Apellido']}</td>
            <td>{$entry['Telf']}</td>
        </tr>";
}

echo "</table>";
?>
