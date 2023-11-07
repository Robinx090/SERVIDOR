<?php
// En el caso de que haya puesto una categoría anteriormente y se haya guardado en una cookie, se ejecutará la siguiente función
if(isset($_COOKIE['categoria'])){
    MostrarProducto();
} else { // En el caso de que no haya puesto ninguna categoría anteriormente, se ejecutará la siguiente función
    MostrarCategoria();
}

function MostrarProducto(){
    echo "<h1>Productos de la categoria</h1>";

    $fopen = fopen('camisetas.csv', 'r'); // Abrimos el fichero en modo lectura
    $header = fgetcsv($fopen, 1000, ","); // Guardamos la cabecera de nuestro archivo CSV
    $categoria = isset($_COOKIE['categoria']) ? $_COOKIE['categoria'] : null;

    echo "<b>$categoria</b><br><br>";
    echo "<ul>"; // Inicio de una lista no ordenada para mostrar las tallas y colores
    // A medida que vamos recorriendo nuestro archivo, lo vamos guardando en nuestra variable 'data'
    while($data = fgetcsv($fopen, 1000, ",")){
        // Si coincide con la categoría, guardaremos las tallas y colores que hay en esa categoría
        if($categoria === $data[0]){
            echo "<li><b>Talla:</b> {$data[1]}, <b>Colores:</b> {$data[2]}</li>";
        }
    }

    echo "</ul>"; // Fin de la lista no ordenada

    fclose($fopen);
}

// En este método mostraremos las categorías que hay de la ropa y luego enviaremos el formulario para guardar la cookie, de la elección del usuario
function MostrarCategoria(){
    echo"
        <h1>Cookies para tiendas</h1>
        <form method='POST'>
            <label for='categoria'>Categoria:</label>
            <select id='categoria' name='categoria'>
                <option value='camisetas'>Camisetas</option>
                <option value='pantalones'>Pantalones</option>
            </select>
            <input type='submit' value='Buscar' name='buscar'>
        </form>";

    // Cuándo el usuario envíe el formulario, se creará la cookie
    if(isset($_POST['buscar'])){
        // Comprobamos que se haya hecho el envío con el método POST y que hayan puesto la categoría de ropa
        $categoria = $_POST['categoria']; // Guardamos la categoría que haya puesto el usuario
        setcookie('categoria', $categoria, time() + 100); // Establecemos los parámetros de las cookies
        header("Location:index.php"); // Redirigimos a la página actual para cargar la cookie
    }
}
?>
