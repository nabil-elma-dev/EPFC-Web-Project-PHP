<?php 
    require_once "functions.php";
    check_login();
    $pdo = connect();


    if(isset($_GET["pseudo"])) {
        $pseudo = trim($_GET["pseudo"]);
    } else {
        $pseudo = $user;
    }
    
    try {
        $query = $pdo->prepare("SELECT * FROM Members WHERE pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
        $profile = $query->fetch();
    } catch (Exception $exc) {
        abort($e);
    }

    if ($profile === false) {
        abort("Can't find user " . $pseudo . " in the database.");
    } else {
        $description = $profile["profile"];
        $picture_path = $profile["picture_path"];
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>TODO's Profile!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">TODO's Profile!</div>
        <?php include "menu.php"; ?>
        <div class="main">
            <div>
                <?php if (mb_strlen($description ?? '') == 0): ?>
                    <?= 'No profile string entered yet!' ?>
                <?php else : ?>
                    <?= escape($description) ?>
                <?php endif; ?>
            </div>
            <div>
                <?php if(mb_strlen($picture_path ?? '') == 0) : ?>
                    <?= 'No picture loaded yet!' ?>
                <?php else : ?>
                    <img src="<?= $picture_path ?>" alt="$pseudo&apos;s picture" width="100" >
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
