<?php
    if(isset($_GET["bef"])){
        $bef = $_GET["bef"];
        if(is_numeric($bef)){
            $eur = $bef/40.3399;
            $msg = "$bef BEF = $eur EUR";
        }
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Convertisseur de francs belges en euros</title>
    </head>
    <body>
        <h1>Convertisseur de francs belges en euros</h1>
        <?php
            if(isset($msg)){
                echo "<p>$msg</p>";
            } else {
                echo <<<END
                <form method="get" action="convertisseur.php">
                    <p>BEF : <input type="number" name="bef"/></p>
                    <p><input type="submit" name="Convertir"/></p>
                 </form>
END;
            }
        ?>
    </body>
</html>