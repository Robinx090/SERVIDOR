<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITV</title>
</head>
<body>
    <form action = "muestraDatos.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="matricula">Matricula:</label>
        <input type="text" id="matricula" name="matricula" required><br><br>

        <label for="telefono">Telefono: </label>
        <input type="number" id="telefono" name="telefono" required><br><br>

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="marca">Marca:</label>
        <select name="marca" id="marca">
            <?php
                include("muestraDatos.php");
                echo LEER();
            ?>
        </select><br><br>

        <input type="radio" name="seguro" id="seguro" value="Con Seguro" required>
        <label for="seguro">Con seguro</label><br><br>

        <input type="radio" name="seguro" id="noSeguro" value="Sin Seguro" required>
        <label for="noSeguro">Sin seguro</label>

        <p>Horas de llamada</p>

        <input type="checkbox" name="manana" id="manana" value="Mañana">
        <label for="manana">Mañana</label><br><br>

        <input type="checkbox" name="tarde" id="tarde" value="Tarde">
        <label for="tarde">Tarde</label><br><br>

        <input type="checkbox" name="noche" id="noche" value="Noche">
        <label for="noche">Noche</label><br><br>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>