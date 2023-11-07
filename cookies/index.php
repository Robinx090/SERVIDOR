<?php
    // Lo primero que vamos a comprobar es, si el usuario ya había elegido una opción o no, con la ayuda de !isset($_COOKIE)
    if(!isset($_COOKIE['categoria'])){
        // En caso de que no tenga establecida una cookie con anterioridad, llamaremos a la siguiente función
        MUESTRA_CATEGORIAS(); 
    }else{
        // En caso contrario, llamaremos a otra función que tenga establecida la cookie
        MUESTRA_PRODUCTOS();
    }

    // Lo primero que vamos a hacer es crear la función de inicio sin cookies
    function MUESTRA_CATEGORIAS(){
        // Creamos nuestro formulario de inicio
        echo "
            <h1>Cookies para tiendas</h1>
            <form method='POST'>
                <label for='seleccion_ropa'></label>
                <select name='categoria' id='seleccion_ropa'>
                    <option value='Camisetas'>Camisetas</option>
                    <option value='Pantalones'>Pantalones</option>
                </select>
                <input type='submit' value='Buscar' name='busqueda'>
            </form>
        ";

        // Después en cuánto el usuario envíe el formulario, procederemos a crear la cookie
        if(isset($_POST['busqueda'])){
            $categoria = $_POST['categoria']; // Guardamos la categoria que haya puesto el usuario
            /* Establecemos los parámetros, con los cuáles el nombre de la cookie es 'categoria', 
            el valor de la cookie será la categoria que haya usado el usuario y el tiempo de expiración será de 1 minutos*/
            setcookie('categoria', $categoria, time() + 60);
            header("Location: index2.php"); // Y en cuánto tengamos la cookie, volveremos a hacer como que recargamos nuestra pagina con la cookie establecida
        }
    }

    // Una vez mostrado el formulario y configurado nuestra cookie le mostraremos al usuario los producto
    function MUESTRA_PRODUCTOS(){
        echo "<h1>Productos de la tienda:</h1>";

        // Comprobaremos que la categoria esté en la cookie guardada, en caso contrario será un nulo
        $categoria = isset( $_COOKIE['categoria'] ) ? $_COOKIE['categoria'] : null;
        $fopen = fopen("ropa.csv", "r"); // Abrimos nuestro archivo para leerlo, dónde guardamos las camisetas y pantalones
        $header = fgetcsv($fopen, 1000, ","); // Nos guardamos las cabeceras

        echo "Tipo de categoria: <b>$categoria</b>";
        echo "<ul>";
        // Recorremos nuestro archivo con un bucle, a la vez que iremos imprimiendo resultados
        while($data = fgetcsv($fopen, 1000, ",")){
            // En el caso de que la categoria del usuario sea igual a nuestra categoria de nuestro archivo csv
            if($categoria == $data[array_search("categoria", $header)] ){
                echo "<li><b>Talla:</b> {$data[array_search('talla', $header)]} <b>Color:</b> {$data[array_search('color', $header)]}</li>";
            }
        }
        echo "</ul>";
        fclose($fopen);
    }
?>
