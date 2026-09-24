<!DOCTYPE html>
<html>
<head>
    <title>exercice 3</title>
</head>
<body>
    <h1> table </h1>
    <p>
        <?php 
            $user = array("Nom" => "Dupont",
                        "Prénom" => "Jacques",
                        "Rue" => "Rue du Web",
                        "Numéro" => "60",
                        "Code Postal" => "4242",
                        "Ville" => "WebCity",
                        "Téléphone" => "0488/42 42 42");
         ?>         
         <table>
            <?php 
                foreach($user as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $key . "<td>";
                    echo "<td>" . $value . "<td>";
                    echo "</tr>";
                }
            ?>
         </table>  
    </p>
</body>
</html>