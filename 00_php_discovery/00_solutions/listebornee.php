<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste</title>
    </head>
    <body>
        <?php
            if(isset($_GET["inf"]) && isset($_GET["sup"])){
                $inf = $_GET["inf"];
                $sup = $_GET["sup"];
                //on verifie que $inf et $sup sont des strings numeriques !
                if(is_numeric($inf) && is_numeric($sup)){
                    //conversion en entier (l'utilisateur aurait pu rentrer
                    //des reels).
                    $inf = (int)$inf;
                    $sup = (int)$sup;
                    echo "<ul>";
                    for($i = $inf; $i <= $sup; ++$i){
                        echo "<li>" . $i . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>les paramètres ne sont pas numériques</p>";
                }
            } else {
                echo "<p>Veuillez entrer les deux variables inf et sup via la méthode GET</p>";
            }
        ?>
    </body>
</html>