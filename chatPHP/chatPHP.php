<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        .contenedor{
            display: flex;
            flex-direction: column;
            border: 1px solid;
            width: 50%;
            text-align: center;
            margin:auto;
        }

        .buton{
            font-size: 1.5em;
        }

        .comentario{
            height: 5vh;
            width:99%;
            font-size: 20px;
        } 
        
        form{
            margin-top: 12em;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    // En el caso de que no haya iniciado sesión
        if(!isset($_SESSION['usuario'])){
            header("Location: index.php");
            exit();
        }
        // En el caso de que haya puesto algo en el chat, guardaremos el mensaje y lo mostraremos por pantalla
        if(isset($_POST['chat'])){
            $text = $_POST['chat']; // Guardamos el mensaje en una variable
            $date = date('Y-m-d / H:i:s'); // Guardamos la fecha y hora actuales
            $user = $_SESSION['usuario']; // Accedemos a la sesión del usuario
            $comentario = [$user, $text, $date]; // Guardamos en un array los valores que vayamos a guardar en nuestro registro
            
            $openFile_chat = fopen("comentarios.csv", "a");
            // En el caso de que no este vacío el texto, entonces escribiremos en nuestro registro de conversaciones lo que ponga el usuario
            if(!empty($text)){
                // Y ahora pondremos los datos en nuestro registro de conversaciones y en cada iteracción se guardará en otro campo
                fputcsv($openFile_chat, $comentario, ";");
            }
            fclose($openFile_chat);
        }
            
        // Una vez escribimos los comentarios que pone el usuario con su fecha/hora y su nombre de usuario, ahora toca leer esos comentarios con su información
        $ReadOpenFile_chat = fopen("comentarios.csv", "r");
        $header = fgetcsv($ReadOpenFile_chat, 1000, ";"); // Guardamos el valor de la cabecera para que no se pueda visualizar
        $comentarios = []; // Inicializamos un array para poder guardar todos los comentarios del usuario
        
        while($datosChat = fgetcsv($ReadOpenFile_chat, 1000, ";")){
            $comentarios[] = $datosChat; // En cada iteracción me dará los datos del nuevo chat
        }
        
        // Ahora guardaremos en una variable los 5 últimos
        $limit_comentarios = array_slice($comentarios, -5);

        fclose($ReadOpenFile_chat);
    ?>

    <div class= 'contenedor'>
        <form method='POST'>
            <div>
                <?php  
                    // A la vez que recorremos el array de '$limit_comentarios', los almacenamos en '$comentario' de forma simultánea
                    foreach ($limit_comentarios as $comentario){
                        echo  
                            "<p>
                                <b>Usuario:</b> {$comentario[0]}&nbsp&nbsp&nbsp&nbsp&nbsp{$comentario[1]}&nbsp&nbsp&nbsp&nbsp&nbsp<b>[{$comentario[2]}]</b>
                            </p>";
                    }
                ?>
            </div>
            <input type='text' placeholder= 'Pon Comentario' class= 'comentario' name= 'chat'>
            <input type='submit' value='Enviar' class= 'buton'>
        </form>
    </div>
</body>
</html>