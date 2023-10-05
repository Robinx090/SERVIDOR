<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{
        text-align: center;
        }

        form{
        }

        .num1, .num2, .operador{
            text-align: center;
            font-size: larger;
            width: 3em;
        }

        .usNum{
            font-size: larger;
        }

        .verificar{
            font-size: larger;
        }   
        
        @media screen and (max-width:760px) {
            body {
                font-size: 14px; /* Cambiar el tamaño de fuente para dispositivos móviles */
            }
        }
    </style>
    
</head>
<body>
    <h1>Operaciones Aleatorias</h1>

    <!--Creamos un formulario dónde tengamos los números aleatorios-->
    <form action="muestraDatos.php" method="POST">
        
        <?php 
            $arrayName = array("+", "-", "*", "/");
            $randOp = rand(0,3);

            //Creamos dos variables que guardarán diferentes números entre 1 y 50
            $randNum1 = rand(1, 50);
            $randNum2 = rand(1, 50);
            //Para que nos sea más fácil calcularlo para la práctica pondremos una condición la cuál si resulta que el número 2 es más grande que el 1, que se cambien
            if($randNum2 > $randNum1){
                $randNum1_ = $randNum2;
                $randNum2 = $randNum1;
                $randNum1 = $randNum1_;
            }
        ?>

        <input type="number" class = "num1" name="num1" readonly value="<?php echo $randNum1?>"> 
        
        <input type="text" class ="operador" name="op" readonly value = "<?php echo $arrayName[$randOp];?>">

        <input type="number" class ="num2" name = "num2" readonly value="<?php echo $randNum2?>">

        <input type="number" class="usNum" name= "usNum" placeholder = "Introduzca un Valor">

        <input type="submit" class="verificar" value="Verificar" id ="verificar">

    </form>
</body>
</html>