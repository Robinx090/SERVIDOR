<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function LEER(){
            $agenda = fopen("agenda.csv", "r");// Vamos a abrir el archivo y haremos que lo lea

            echo "<table border ='1' style = 'border-collapse: collapse;'>";
                while ($contactos = fgetcsv ($agenda, 1000, ";")) { // La función nos devuelve la apertura del archivo csv, el tamaño del buffer y el delimitador de columnas
                    echo 
                    "<tr>
                        <td style = 'border: 1px solid;'>$contactos[0]</td>
                        <td style = 'border: 1px solid;'>$contactos[1]</td>
                        <td style = 'border: 1px solid;'>$contactos[2]</td>
                    </tr>";
            }
            echo "</table>";

            fclose($agenda);
        }
        
        function ESCRIBIR($nombre, $apellido, $telefono){

            $agenda = fopen("agenda.csv", "a"); //Abrimos el archivo para poder escribir en él
            $nuevo_Contacto = array($nombre, $apellido, $telefono);

            fputcsv($agenda, $nuevo_Contacto, ";");

            fclose($agenda);
        }

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $telefono = $_POST['telefono'];

            ESCRIBIR($nombre, $apellido, $telefono);
        }

        LEER();
    ?>


    <br><br>
    <form action="index.php" method = "POST">
        <label for="nombre">Nombre: </label>
        <input type="text" id = "nombre" name="nombre" style = "margin-left: 4px;" placeholder = "Julian" required><br>

        <label for="apellido">Apellido: </label>
        <input type="text" id = "apellido" name="apellido" placeholder = "Sánchez" required><br>

        <label for="telefono">Telefono: </label>
        <input type="number" id = "telefono" name="telefono" placeholder = "652348925" required><br><br>

        <input type="submit" value="Añadir Contacto">
    </form>
    <br><br>
</body>
</html>
