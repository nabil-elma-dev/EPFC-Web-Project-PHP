<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tableau</title>
    </head>
    <body>
        <h1>Contenu du tableau</h1>
        <?php
            $utilisateur["Nom"] = "Dupont";
            $utilisateur["Prenom"] = "Jacques";
            $utilisateur["Rue"] = "Rue du Web";
            $utilisateur["Numéro"] = 60;
            $utilisateur["Code Postal"] = "4242";
            $utilisateur["Ville"] = "WebCity";
            $utilisateur["Téléphone"] = "0488/42 42 42";
        ?>
        <table>
            <?php
                foreach($utilisateur as $cle => $valeur) {
                    echo "<tr><td>" . $cle . "</td><td>" . $valeur . "</td></tr>";
                }
            ?>
            
        </table>
       
    </body>
</html>