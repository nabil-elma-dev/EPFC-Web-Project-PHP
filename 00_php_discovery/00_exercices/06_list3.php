<!DOCTYPE html>
<html>
    <head>
        <title>list2</title>
    </head>
    <body>
        <h1>list2</h1>
        <?php 
            /*
            ENDGOAL: 
            case 1= parametri ricevuti in GET, easy
            case 2= parametri non ricevuti in get, quindi formulario per POST
            */
            global $inf;
            global $sup;
            if (isset($_GET["inf"]) || isset($_GET["sup"])) {
                if (isset($_GET["inf"]) && isset($_GET["sup"])) {
                    $inf = $_GET["inf"];
                    $sup = $_GET["sup"];
                    if ($inf === "" || $sup === "") {
                        $errors[] = "(!) Both sup and inf must be filled!";
                    }
                    if(is_numeric($inf) && is_numeric($sup)) {
                        $inf = (int)($inf);
                        $sup = (int)($sup);
                        if ($inf > $sup) {
                            $errors[] = "(!) inf is greater than sup!";
                        } else {
                            echo "<ul>";
                                for ($i = $inf; $i <= $sup; ++ $i) {
                                    echo "<li>" . $i . "</li>";
                                };
                            echo "</ul>";
                        }
                    } else {
                        $errors[] = "(!) At least one among sup and inf is not a number!";
                    }
                } else {
                    $errors[] = "(!) GET method has not been used for at least 1 param between inf and sup ";
                }
            } else {
        ?>
            <form action="06_list3.php" method="POST">
                <p>Borne inférieure: <input type="text" name="inf" /></p>
                <p>Borne supérieure: <input type="text" name="sup" /></p>
                <p> <input type="submit" value="Envoyer" /></p>
            </form>
        <?php 
            if isset($_POST["inf"] && isset["sup"]) {
                if is_numeric["inf"] && is_numeric["sup"] {
                    $inf = (int)($_POST["inf"]);
                    $sup = (int)($_POST["sup"]);
                    if ($inf <= $sup) {
                        echo "<ul>";
                            for ($i = $inf; $i <= $sup; ++ $i) {
                                echo "<li>" . $i . "</li>";
                            };
                        echo "</ul>";
                    }
                }
            }
            }
        ?>
        
    </body>
</html>