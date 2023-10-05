<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $usNum = $_POST['usNum'];
        $op = $_POST['op'];

        if(empty($usNum)){
            echo "No has introducido ningún valor";
        }else{
            function Message($resultadoCorrecto, $usNum){
                if($resultadoCorrecto == $usNum){
                        header("Location: index.php");
                        exit();
                }
                else{
                    echo "El Resultado no es Correcto";
                }
            }

            switch($op){
                case "+":
                    $resultadoCorrecto = $num1 + $num2;
                    Message($resultadoCorrecto, $usNum);
                break;
    
                case "-":
                    $resultadoCorrecto = $num1 - $num2;
                    Message($resultadoCorrecto, $usNum);
                break;
    
                case "*":
                    $resultadoCorrecto = $num1 * $num2;
                    Message($resultadoCorrecto, $usNum);
                break;
    
                case "/":
                    if($num2 == 0){
                        echo "No se puede dividir entre 0";
                    }else if($num1 == 0 & $num2 == 0){
                        echo "Resultado Indefinido";
                    }
                    $resultadoCorrecto = $num1 / $num2;
                    Message($resultadoCorrecto, $usNum);
                break;
            }
        }
    ?>
    
    <br>

    <input type ="button" onclick="history.back()" name="vuelta" value="Vuelta">
    
    <br>
</body>
</html>