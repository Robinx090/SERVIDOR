<?php
    // Accedemos al archivo JSON que hemos creado anteriormente con un par de rutas de imagenes de perros dentro
    $json = file_get_contents('imagenes.json');
    
    // Decodificamos al archivo JSON para que sea más legible y lo trataremos como un array asociativo
    $data = json_decode($json, true);

    // Cogemos las rutas de las imagenes que se encuentran en el archivo
    $pathImage = $data['images']; // En json la clave es: 'images'

    // Generamos una imagen aleatoria
    $randImage = $pathImage[ array_rand($pathImage) ];

    // Guardamos el tamaño de pixeles que queremos que tengan nuestras imagenes de ancho y alto
    $width = 500;
    $height = 500;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            font-size: larger;
        }
    </style>
</head>
<body>
    <form action="index.php" method="POST">
        <div>
            <?php echo "<img src='$randImage' alt='imagenes_perros' width='$width' height='$height'>"; // Y lo proyectamos para que se pueda ver en nuestra página web?>
        </div>
        
        <input type="submit" value="Cambiar Imagen">
    </form>
</body>
</html>