<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exercise 7 bis</title>
    </head>
    <body>
        <?php
        // Analysing POST value
            $BEfranc = isset($_POST["BEfranc"]) ?
                $_POST["BEfranc"]
                : "";
        
            if (trim($BEfranc) === "") {
                $errors[] = "(!) Value is required!";
            }
            if (!is_numeric($BEfranc)) {
                $errors[] = "(!) Value put is not a number!";
            } else if ($BEfranc < 0) {
                $errors[] = "(!) Value put is not a positive number!";
            }

            if (empty($errors)) {
                echo $BEfranc / 40.3399; 
                echo "<a href='/tp1/ex_7bis.php'>";
                    echo "Put another BE franc value";
                echo "</a>";
            } else {
        ?>
        
    </body>

    <form action="ex_7bis.php" method="POST">
        <p>Value (Belgian francs): <input type="text" name="BEfranc"> </p>
        <p> <input type="submit" value="Submit" /></p>
    </form>

        <?php
            } 
        ?>
</html>