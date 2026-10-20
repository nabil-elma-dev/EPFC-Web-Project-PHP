<?php 
    require_once "functions.php";
    check_login();
    $pseudo = $_SESSION['user'];

    // grabbing user's description and picture_path
    try {
        $query = $pdo->prepare('SELECT profile, picture_path FROM Members WHERE pseudo = :pseudo');
        $query->execute(["pseudo" => $pseudo]);
        $member_record = $query->fetch();
    } catch (Exception $e) {
        die("Error while accessing database. Please contact your administrator.");
    }

    $profile_description = $member_record["profile"];
    $profile_picture = $member_record["picture_path"];

    // calling update if user typed something on profile textarea
    if (isset($_POST["profile"])) {
        $new_profile_description = trim($_POST["profile"]);
        try {
            $query = $pdo->prepare("UPDATE Members SET profile = :profile WHERE pseudo = :pseudo");
            $query->execute(["profile" => $new_profile_description, "pseudo" => $pseudo]);
        } catch (Exception $e) {

        };
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Update Your Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Update Your Profile</div>
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>

        <div class="main">
            <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                <h4>Enter or edit your details and/or upload an image.</h4>
                <textarea name="profile" cols="50" rows="3"><?= 
                isset($new_profile_description) ? 
                    escape($new_profile_description) 
                    : escape($profile_description) 
                ?></textarea>

                Image: <input type="file" name="image" accept="image/x-png, image/gif, image/jpeg">
                <img src="<?= $profile_picture ?>" width="100" alt="profile picture">

                <input type="submit" value="Save Profile">
            </form>
        </div>

        <?php if (isset($_POST["profile"]) && $_SERVER["REQUEST_METHOD"] === "POST"): ?>
            <div class="success"> your profile has been succcessfully updated. </div>
        <?php endif; ?>

    </body>
</html>