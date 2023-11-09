<?php
    // Accedemos a la URL que nos proporciona el profesor en el aula y guardamos el contenido en nuestra variable 'json'
    $json = file_get_contents('https://dog.ceo/api/breeds/image/random');
    
    // Decodificamos al archivo JSON para que sea más legible
    $data = json_decode($json);

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
            <?php echo "<img src='$data->message' alt='imagenes_perros' width='$width' height='$height'>"; // Y lo proyectamos para que se pueda ver en nuestra página web?>
        </div>
        
        <input type="submit" value="Cambiar Imagen">
    </form>
</body>
</html>