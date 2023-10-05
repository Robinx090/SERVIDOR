<!DOCTYPE html>
<html>
<head>
    <title>Resultado del Formulario</title>
</head>
<body>
    <?php

    function LEER(){
        $leerDatos = fopen("marcas.csv", "r");
        $option = "";
        while($datos = fgetcsv($leerDatos, 1000, ";")){
            $valueOption = $datos[0];
            $usOption = $datos[1];
            $option .= "<option value = '$valueOption'>$usOption</option>";
        }
        fclose($leerDatos);
        return $option;
    }

    function ESCRIBIR($nombre, $matricula, $tel, $email, $marca, $seguro){ // Creamos una función la cuál recoja los datos por parámetros
        $datos = fopen("itv.csv", "w"); // Creamos o abrimos el archivo y con opción para poder escribir, como no hay nada que sobreescribir lo ponemos con 'w', para la práctica
        $titulos = array("NOMBRE", "MATRICULA", "TELEFONO", "EMAIL", "MARCA", "SEGURO"); // Guardamos un array de nombres para el encabezado de nuestro archivo
        fputcsv($datos, $titulos, ";"); // Introducimos los datos y con ';' separamos en cada columna sus valores

        $meteDatos = array($nombre, $matricula, $tel, $email, $marca, $seguro);
        fputcsv($datos, $meteDatos, ";");

        fclose($datos); // Y cerramos el fichero
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = $_POST["nombre"];
        $matricula = $_POST["matricula"];
        $tel = $_POST["telefono"];
        $email = $_POST["email"];
        $marca = $_POST["marca"];
        $seguro = $_POST["seguro"];

        ESCRIBIR($nombre, $matricula, $tel, $email, $marca, $seguro);
    }

        //En el caso de que haya puesto que puede en la mañana mostraremos el mensaje de que puede en la mañana
        if (isset ($_POST["manana"])){
            $manana = $_POST["manana"];
        }
        //En el caso de que no, pondremos que no hay mensaje
        else{
            $manana = "";
        }

        //En el caso de que haya puesto que puede en la tarde mostraremos el mensaje de que puede en la tarde
        if (isset ($_POST["tarde"])){
            $tarde = $_POST["tarde"];
        }
        //En el caso de que no, pondremos que no hay mensaje
        else{
            $tarde = "";
        }

        //En el caso de que haya puesto que puede en la noche mostraremos el mensaje de que puede en la noche
        if (isset ($_POST["noche"])){
            $noche = $_POST["noche"];
        }
        //En el caso de que no, pondremos que no hay mensaje
        else{
            $noche = "";
        }

        echo 
            "<table border = 2>
                <tr>
                    <th>Nombre:</th>
                    <td>$nombre</td>
                </tr>
                <tr>
                    <th>Matricula:</th>
                    <td>$matricula</td>
                </tr>
                <tr>
                    <th>Teléfono:</th>
                    <td>$tel</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>$email</td>
                </tr>
                <tr>
                    <th>Marca:</th>
                    <td>$marca</td>
                </tr>
                <tr>
                    <th>Seguro:</th>
                    <td>$seguro</td>
                </tr>
                <tr>
                    <th>Hora Disponible:</th>
                    <td>$manana $tarde $noche</td>
                </tr>
            </table>";
    ?>
</body>
</html>
