<?php 
    // grab functions 
    require_once "functions.php";
    
    // grab post vars
    $pseudo = isset($_POST["pseudo"]) ? trim($_POST["pseudo"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    // grab record
    try {
        $query = $pdo->prepare("SELECT pseudo, password FROM Members WHERE pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
        $memberRecord = $query->fetch();
    }
    catch (Exception $exc) {
        die("Error while accessing database. Please contact your administrator.");
    }
    // user's data analysis
    if ($query->rowCount() === 0 || ($pseudo !== $memberRecord["pseudo"])) {
        $error = "Can't find a member with the pseudo '$pseudo'. Please sign up.";
    } elseif ($query->rowCount() === 1 && $memberRecord["password"] !== $password) {
        $error = "Wrong password. Please try again.";
    }

    /* CASES:
    User KO && Password KO --> if 
    User KO && Password OK --> if
    User OK && Password KO --> else
    User OK && Password OK --> ok        
    */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Log In</div>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="signup.php">Sign Up</a>
        </div>
        <div class="main">
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo:</td>
                        <td><input id="pseudo" name="pseudo" type="text" value=
                        <?= $pseudo === $memberRecord["pseudo"] ? $pseudo : "" ?>></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=""></td>
                    </tr>
                </table>
                <input type="submit" value="Log In">
            </form>
        </div>
        <?php if (isset($error) && $_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <div class="errors"> <?= $error ?> </div>
        <?php endif; ?>
        
        <?php if (!isset($error)) {
            $url = 'http://localhost/my_social_network_base/profile.php?pseudo=' . escape($pseudo);
            redirect($url);
        } ?>
        </body> 
</html>
