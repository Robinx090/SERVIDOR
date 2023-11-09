<?php
    // Creamos el formulario que mostrará al usuario el desplegable de los municipios con el que podrá ver sus respectiva temperatura minima y máxima
    echo "
        <h1>Temperatura de los Municipios</h1>
        <form method='POST'>
            <label for='municipio'>Elija un municipio:</label><br>
            <select name='municipio' id='municipio'>
                <option value ='' style='display:none;'>Municipio</option>
                <option value='alcorcon'>Alcorcón</option>
                <option value='mostoles'>Móstoles</option>
                <option value='fuenlabrada'>Fuenlabrada</option>
            </select>
            <input type='submit' value='Ver' name='envio'>
        </form>
    ";

    // Verificamos si se ha hecho el envío del formulario
    if(isset($_POST['envio'])){
        $municipio = $_POST['municipio']; // Guardamos el municipio que haya elegido el usuario
        LECTURA_TEMPERATURAS($municipio); // Accedemos a la función enviando el municipio que a elegido el usuario
    }
    
    function LECTURA_TEMPERATURAS($municipio){
        $array_municipios = ['alcorcon', 'mostoles', 'fuenlabrada']; // Creamos un array de los municipios que nos encontramos en nuestro desplegable
        
        // En el caso de que exista el municipio puesto por el usuario en nuestro array de municipios devolverá un true, y nos ejecutará el siguiente código 
        if(in_array($municipio, $array_municipios)){
            $xml = simplexml_load_file($municipio.'.xml');  // Cargamos el archivo XML
            $titulo = strtoupper($municipio);
            echo "
                <table style='text-align: center;'>
                    <tr> <th colspan='3' > <b>$titulo</b> </th> </tr>
                    <tr>
                        <th style='border:1px solid;'>Fecha</th>
                        <th style='border:1px solid;'>Temperatura Máxima</th>
                        <th style='border:1px solid;'>Temperatura Mínima</th>
                    </tr>
            ";
            // Recorremos los días, que se encuentran dentro de las predicciones y guardamos esos días en nuestra variable $dia
            foreach($xml->prediccion->dia as $dia){
                $fecha = $dia['fecha']; // Guardaremos la fecha
                $max = $dia->temperatura->maxima; // Guardaremos la temperatura máxima
                $min = $dia->temperatura->minima; // Guardaremos la temperatura mínima
                echo " 
                    <tr>
                        <td style='border:1px solid;'>$fecha</td>
                        <td style='border:1px solid;'>$max º</td>
                        <td style='border:1px solid;'>$min º</td>
                    </tr>
                ";
            }
            echo "</table>";
        }
    }

?> 