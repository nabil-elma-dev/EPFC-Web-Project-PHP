<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche documentaire</title>
    </head>
    <body>
        <h1>Fonctions sur les strings</h1>
        
        <h2>Exercice 1 : Longueur</h2>
        <p>
            La longueur de "bonjour" est <?php echo strlen('bonjour'); ?>
        </p>
        <p>
            La longueur de "ééé" est <?php echo strlen('ééé'); ?>.
        </p>
        <p>
            En fait, <code>strlen</code> calcule le nombre de bytes du string.
            Pour calculer le nombre de caractères, utilisez <code>mb_strlen</code> (mb = multi bytes):
        </p>
        <p>
            La longueur de "ééé" est <?php echo mb_strlen('ééé'); ?>.
        </p>
        
        <h2>Exercice 2 : Contenance</h2>
        <p>
            Est ce que "abc@def" contient un "@" ?
            <?php 
            //ATTENTION : il faut comparer le retour de strpos
            //avec === ou !== car elle peut renvoyer soit FALSE
            //soit un entier. Il faut donc empecher la conversion
            //automatique de types. Si on convertit FALSE en un entier,
            //cela donne l'entier 0. 
                $pos = strpos("abc@def","@");
                if($pos !== FALSE)
                    echo "oui, en position $pos";
                else
                    echo "non.";
            ?>     
        </p> 
        <p>
            Est ce que "abcdef" contient un "@" ?
            <?php 
            //même remarque
                $pos = strpos("abcdef","@");
                if($pos !== FALSE)
                    echo "oui, en position $pos";
                else
                    echo "non.";
            ?>     
        </p>
        <h3>Variante avec <code>str_contains</code></h3>
        <p>
            Est ce que "abc@def" contient un "@" ?
            <?php
            if(str_contains("abc@def","@"))
                echo "oui.";
            else
                echo "non.";
            ?>
        </p>
        
        <h2>Exercice 3 : Position</h2>
        <p>
            Est-ce que "@abc" commence par un "@" ?
            <?php 
            //même remarque
                if(strpos("@abc","@") === 0)
                    echo "oui.";
                else
                    echo "non.";
            ?>     
        </p>
        <p>
            Est-ce que "a@bc" commence par un "@" ?
            <?php 
            //même remarque
                if(strpos("a@bc","@") === 0)
                    echo "oui.";
                else
                    echo "non.";
            ?>     
        </p>
        <p>Il existe également <code>str_start_with</code> / <code>str_end_with</code>.</p>
        
        <h2>Exercice 4 : Sous-chaîne</h2>
        <p>
            "Bonjour" sans sa première lettre donne : 
            <?php echo substr("Bonjour", 1); ?>     
        </p>
        
        <h2>Exercice 5 : Découpage</h2>
        <p>
            "La vie est belle" contient les mots (séparés par des espaces) suivants : 
        </p>
        <ul>
            <?php
                $tab = explode(" ", "La vie est belle");
                foreach($tab as $word)
                    echo "<li>".$word."</li>";
            ?>
        </ul>
        
        <h2>Exercice 6 : Trim</h2>
        <!-- Remarque : utilisation de l'élément <pre> pour afficher les
             espaces (texte préformaté : conserve l'indentation (espaces, 
             retours à la ligne...). -->
        <pre>"   La vie est belle  "</pre>
        sans les espaces en début et en fin donne
        <pre>"<?php echo trim("   La vie est belle  "); ?>"</pre>
        
        <h2>Exercice 7 : Remplacement</h2>
        <p>
            "abcxxxabc" où chaque "abc" est remplacé par "def" donne "
            <?php echo str_replace("abc", "def", "abcxxxabc"); ?>"
        </p>
        
    </body>
</html>