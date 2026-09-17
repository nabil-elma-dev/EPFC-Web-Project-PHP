<!DOCTYPE html>
<html>
    <head>
        <title>Table</title>
    </head>
    <body>
        <h1> table </h1>
        <ul>
            <?php 
                for ($number = 1; $number < 10; ++$number) {
                    echo "<li>" . $number . "</li>";
                }
            ?>
        </ul>
    </body>
</html>