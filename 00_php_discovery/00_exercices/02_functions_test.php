<!DOCTYPE html>
<html>
<head>
    <title>exercice 2</title>
</head>
<body>
    <h1> Functions </h1>
    <p>
        <?php 
            /* Comment déterminer la taille d'une chaîne de caractères ?
            source: https://www.php.net/manual/en/function.strlen.php */
            $test1 = "Length of this string should be 34";
            echo $test1 . "\n -> \n";
            echo strlen($test1) === 34 ?
                "php check: OK (strlen shows 34)"
                : "php check: KO (strlen does not show 34)";
            echo "<br> <br>";

            /* Comment déterminer si une chaine de caractères contient un @ ?
            source: https://www.php.net/manual/en/function.str-contains.php */
            $test2_A = "Hello W@rld";
            $test2_B = "Hello World";     
            echo $test2_A . "\n -> \n";
            echo str_contains($test2_A, '@') ?
                "php check: OK (boolean is true)"
                : "php check: KO (boolean is false)";
            echo "<br>";
            echo $test2_B . "\n -> \n";
            echo str_contains($test2_B, '@') ?
                "php check: OK (boolean is true)"
                : "php check: KO (boolean is false)";
            echo "<br> <br>";

            /* Comment déterminer si une chaîne de caractères commence par un @ ?
            source: https://www.php.net/manual/en/function.str-starts-with.php */
            $test3_A = "@rt"; 
            $test3_B = "art";
            echo $test3_A . "\n -> \n";
            echo str_starts_with($test3_A, '@') ?
                "php check: OK (boolean is true)"
                : "php check: KO (boolean is false)";
            echo "<br>";
            echo $test3_B . "\n -> \n";
            echo str_starts_with($test3_B, '@') ?
                "php check: OK (boolean is true)"
                : "php check: KO (boolean is false)";
            echo "<br> <br>";

            /* Comment enlever le premier caractère d'une chaîne ? 
            source: https://stackoverflow.com/questions/26552735/how-to-cut-only-the-first-character-in-a-string */
            $test4 = "kart";
            echo $test4 . "\n -> \n";
            echo substr($test4, 1) === "art" ?
                "php check: OK (kart into art with substr)"
                : "php check: KO (wrong conversion)";
            echo "<br> <br>";

            /*  Comment transformer une chaîne de caractères en un tableau de mots (si les mots sont séparés par des espaces).
            source : https://www.php.net/manual/en/function.explode.php ; 
            */
            $test5 = "A B C D E";
            echo $test5 . "\n -> \n post explode function: ";
            echo "<br>";
            $tab = explode(" ", $test5);
            static $counter = 0;
            foreach ($tab as $letter) {
                echo "tab[$counter]: " . $letter . "<br>";
                ++$counter;
            }; 
            echo "<br>";

            /* Comment enlever les espaces qu'il y aurait au début et à la fin d'une chaîne de caractères ?
            source: 
            */
            echo $test6 = " testing trim function    " . "\n -> \n";
            $test6 = trim($test6);
            echo !(str_starts_with($test6, " ") || str_ends_with($test6, " ")) ?
                "php check: OK (trim worked)"
                : "php check: KO (trim did not work)";
            echo "<br> <br>";

            /* Comment, dans une chaîne, remplacer toutes les apparitions d'un mot par un autre ?
            source: */
            $test7 = "Hello World of PHP";
            echo $test7;
            echo "\n -> \n";
            $og_words = array("World", "PHP");
            $neo_words = array("Universe", "Internet");
            $test7 = str_replace($og_words, $neo_words, $test7);
            $tab = explode(" ", $test7);
            echo $tab[1] === "Universe" && $tab[3] == "Internet" ?
                "php check: OK (" . $test7 . ")"
                : "php check: KO (" . $test7 . ")";
        ?>
    </p>
</body>
</html>