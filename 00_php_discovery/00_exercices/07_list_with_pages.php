<!DOCTYPE html>
<html>
<head>
    <title>exercise 7</title>
</head>
<body>
    <?php 

// $INF AND $SUP ANALYSIS
        $inf = isset($_GET["inf"]) ?
            $_GET["inf"]
            : "";

        $sup = isset($_GET["sup"]) ?
            $_GET["sup"]
            : "";

        if ($inf === "" || $sup === "") {
            $errors[] = "(!) Both sup and inf are required!.";
        }
        if(is_numeric($inf) && is_numeric($sup)) {
            if ($inf <= 0 || $sup <= 0) {
                $errors[] = "(!) only positive numbers are allowed!";
            }
            if (!is_it_integer($sup) || !is_it_integer($sup)) {
                $errors[] = "(!) at least one between inf and sup is not an integer number";
            }   
            if ($inf > $sup) {
                $errors[] = "(!) inf must not be greater than sup!";
            }
        } else {
            $errors[] = "(!) at least one between inf and sup is not a number";
        }
        

// $ERRORS ARRAY ANALYSIS    
    // IF-CASE : EMPTY $ERRORS              
        if (empty($errors)) {
            // CALCULATING $LAST        
        $last_page = (int) (($sup - $inf) / 20); 

// $PAGE ANALYSIS       
        $page = isset($_GET["page"]) 
                && is_numeric($_GET["page"]) 
                && $_GET["page"] > "0"
                && $_GET["page"] <= $last_page? 
                    (int)($_GET["page"])
                    : 0;

// $THIS_PAGE_MAX_QTY
        $this_page_max_qty = $sup - ($inf + 20 * $page) < 20 ?
                $sup - ($inf + 20 * $page) + 1
                : 20;

        // FOR-EACH NUMBERS (MAX QTY: 20)
            echo "<ul>";

            for ($i = $inf; $i < $inf + $this_page_max_qty; ++ $i) {
                echo "<li>" . ((int) ($i) + $page * 20) . "</li>";
            };

            echo "</ul>";

        // $PAGE_MAX_VALUE CALCULUS    
            $page_max_value = ($sup - $inf) % 20 >= 0 ?
                (int)(($sup - $inf) / 20) 
                : 0;
        
        // "<<"        
            if ($page != 0) { 
                $previous= $page - 1;
                echo "<a href='/tp1/ex_7.php?inf=$inf&sup=$sup&page=$previous'>";
                echo "<<";
                echo "</a>";
            }

        // FOR LOOP PRINTING VALUES (EACH 20)
            for ($i = $inf; $i <= $sup; $i += 20) {
                $current_page = (int)(($i - $inf) / 19);
                echo "<a href='/tp1/ex_7.php?inf=$inf&sup=$sup&page=$current_page'>";
                echo $i;
                echo "</a>";
                echo " ";
            }
        
        // ">>"    
            if ($page < $page_max_value) { 
                $next = $page + 1;
                echo "<a href='/tp1/ex_7.php?inf=$inf&sup=$sup&page=$next'>";
                echo ">>";
                echo "</a>";
            }

            echo "<br>";

        // MODIFY PARAM
            echo "<a href='/tp1/ex_7.php'>";
            echo "Modifier paramètres";
            echo "</a>";
        } 

    // ELSE-CASE : $ERRORS NOT EMPTY    
        else {
            foreach ($errors as $error) {
                echo $error;
                echo "<br>";
            } 
    ?>
    

    <form action="ex_7.php" method="GET">
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