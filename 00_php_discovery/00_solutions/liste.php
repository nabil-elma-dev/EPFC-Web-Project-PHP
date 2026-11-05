<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste</title>
    </head>
    <body>
        <ul>
            <?php
                for($i = 1; $i <= 10; ++$i){
                    echo "<li>" . $i . "</li>";
                }
            ?>
            
        </ul>
    </body>
</html>