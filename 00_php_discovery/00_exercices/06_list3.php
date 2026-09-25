<!DOCTYPE html>
<html>
    <head>
        <title>exercice 6</title>
    </head>
    <body>
        <h1>list2</h1>
                
            <?php 
                $errors = [];
                if (isset($_GET["inf"]) && isset($_GET["sup"])) {
                    $inf = $_GET["inf"];
                    $sup = $_GET["sup"];
                    if ($inf === "" || $sup === "") {
                        $errors[] = "(!) Both sup and inf are required!";
                    }
                    if(is_numeric($inf) && is_numeric($sup)) {
                        if (!is_it_integer($inf) || !is_it_integer($sup)) { 
                            $errors[] = "(!) at least one between inf and sup is not an integer number";
                        }
                        if ($inf > $sup) {
                            $errors[] = "(!) inf must not be greater than sup!";
                        }
                    } else {
                        $errors[] = "(!) at least one between inf and sup is not a number";
                    }
                } else {
                    $errors[] = "(!) At least one of the inf and sup parameters is missing (not provided via GET).";
                }
                if (empty($errors)) {
                    echo "<ul>";
                    for ($i = $inf; $i <= $sup; ++ $i) {
                        echo "<li>" . (int) ($i) . "</li>";
                    };
                    echo "</ul>";
                } else {
                    foreach ($errors as $error) {
                        echo $error;
                        echo "<br>";
                    } 
            ?>
           
            <form action="ex_6.php" method="GET">
                <p>Borne inférieure: <input type="text" name="inf" /></p>
                <p>Borne supérieure: <input type="text" name="sup" /></p>
                <p> <input type="submit" value="Envoyer" /></p>
            </form>
            
            <?php 
                }    
            ?>
            

            <?php
                function is_it_integer(string $n) : bool { // Method based on the one suggested by the user "greg": https://stackoverflow.com/questions/2012187/how-to-check-that-a-string-is-an-int-but-not-a-double-etc
                    $int_n = (int)($n);
                    return $int_n == $n ;
                } 
            ?>
        
        
    </body>
</html>