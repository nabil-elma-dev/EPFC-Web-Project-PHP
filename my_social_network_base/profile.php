<?php 
    if(isset($_GET["pseudo"])) {
        $pseudo = $_GET["pseudo"];
    } else {
        die("This page excepts a 'pseudo' parameter via the GET method");
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=my_social_network_base;charset=utf8mb4", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $pdo->prepare("SELECT * FROM Members WHERE pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
        $profile = $query->fetch();
    } catch (Exception $exc) {
        die("Error while accessing database. Please contact your administrator.");
    }

    if ($query->rowCount() == 0) {
        die("Can't find user '$pseudo' in the database.");
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
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div class="main">
            <div>
                <?php if (mb_strlen($description ?? '') == 0): ?>
                    <?= 'No profile string entered yet!' ?>
                <?php else : ?>
                    <?= $description ?>
                <?php endif; ?>
            </div>
            <div>
                <?php if(mb_strlen($picture_path ?? '') == 0) : ?>
                    <?= 'No picture loaded yet!' ?>
                <?php else : ?>
                    <img src="<?php $picture_path ?>" alt="$pseudo&apos;s picture" width="100" >
                <?php endif; ?>
            </div>
        </div>
    </body>
</html>
