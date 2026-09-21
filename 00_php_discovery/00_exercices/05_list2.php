<!DOCTYPE html>
<html>
    <head>
        <title>list2</title>
    </head>
    <body>
        <h1>list2</h1>
        <?php 
            $errors = [];
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
            foreach ($errors as $error) {
                echo $error;
                echo "<br>";
            }
        ?>
    </body>
</html>