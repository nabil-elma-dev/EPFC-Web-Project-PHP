<?php
    require_once "functions.php"; 

    $pseudo = isset($_POST['pseudo']) ? trim($_POST['pseudo']) : "";
    $password = isset($_POST['password']) ? trim($_POST['password']) : "";
    $password_confirm = isset($_POST['password_confirm']) ? trim($_POST['password_confirm']) : "";
    
    $errors = [];

    try {
        $query = $pdo->prepare("SELECT 1 FROM Members WHERE pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
    } catch (Exception $e) {
        die("Error while accessing database. Please contact your administrator.");
    }

    $memberRecord = $query->fetch();

    if ($pseudo === "") {
        $errors[] = "Username is required!";
    }
    if ($memberRecord !== false) {
        $errors[] = "User " . escape($pseudo) . " already exists!";
    }
    if (strlen($pseudo) < 3) {
        $errors[] = "Pseudo's length must be at least 3!";
    } 
    if ($password === "" || $password_confirm === "") {
        $errors[] = "Both password and password_confirm must be filled!";
    }
    if (strcmp($password, $password_confirm) !== 0) { // source: https://www.php.net/manual/en/function.strcmp.php
        $errors[] = "Passwords put do not match!";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Sign Up</div>
        <div class="menu">
            <a href="index.php">Home</a>
        </div>
        <div class="main">
            <h4>Please enter your details to sign up:</h4>
            <!-- form -->
            <form action="signup.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo:</td>
                        <td><input id="pseudo" name="pseudo" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=""></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input id="password_confirm" name="password_confirm" type="password" value=""></td>
                    </tr>
                </table>
                <input type="submit" value="Sign Up">
            </form>
            <?php if (!empty($errors) && $_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <div>
                    <ul class="errors">
                        <?php foreach ($errors as $error) : ?>
                            <li> <?= $error ?> </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php 
                if(empty($errors)) {
                    try {
                        $query = $pdo->prepare("INSERT INTO Members (pseudo, password) VALUES (:pseudo, :password)");
                        $query->execute(["pseudo" => $pseudo, "password" => $password]);
                        session_regenerate_id(true);
                        $_SESSION["user"] = $pseudo;
                        redirect("profile.php");
                    } catch (Exception $e) {
                        die("Error while accessing database. Please contact your administrator.");
                    }
                } 
            ?>
        </div>
    </body>
</html>
