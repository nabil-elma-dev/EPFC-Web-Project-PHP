<!DOCTYPE html>
<html>
<head>
    <title>exercice 7</title>
</head>
<body>
    <?php 

// $INF AND $SUP ANALYSIS
        if (isset($_GET["inf"]) && isset($_GET["sup"])) {
            $inf = $_GET["inf"];
            $sup = $_GET["sup"];
            if ($inf === "" || $sup === "") {
                $errors[] = "(!) Both sup and inf are required!";
            }
            if(is_numeric($inf) && is_numeric($sup)) {
                if ($inf <= 0 || $sup <= 0) {
                    $errors[] = "(!) only positive numbers are allowed!";
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

// $PAGE ANALYSIS       
        $page = isset($_GET["page"]) 
                && is_numeric($_GET["page"]) 
                && $_GET["page"] !== "0" ? 
                    (int)($_GET["page"])
                    : 0;

// $ERRORS ARRAY ANALYSIS    
    // IF-CASE : EMPTY $ERRORS              
        if (empty($errors)) {
         
        // FOR-EACH NUMBERS (MAX QTY: 20)
            echo "<ul>";
            // $this_page_highest_value = 
            
            
            for ($i = $inf; $i < $inf + 20; ++ $i) {
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
                echo "<a href='/tp1/ex_7.php?inf=$inf&sup=$sup&page=$page'>";
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


</body>
</html>