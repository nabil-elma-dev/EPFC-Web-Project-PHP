<?php 
    require_once "functions.php";
    check_login();

    $pseudo = $_SESSION['user'];

    // grabbing user's description and picture_path
    $member_record = get_member_by_pseudo($pseudo);

    $profile_description = $member_record["profile"];
    $profile_picture = $member_record["picture_path"];

    // calling update if user typed something on profile textarea
    if (isset($_POST["profile"])) {
        $new_profile_description = trim($_POST["profile"]);
        update_profile_description($new_profile_description, $pseudo);
    }

    // analysing image about to be uploaded
    if(isset($_FILES['image']['name']) && $_FILES['images']['name'] !== '') { // instructions says != but it does not work
        if ($_FILES['image']['error'] == 0) {

            $typeOK = TRUE;

            // analysing image's extension
            if($_FILES['image']['type'] == "image/gif") {
                $saveTo = $user . ".gif";
            } else if($_FILES['image']['type'] == "image/jpeg") {
                $saveTo = $user . ".jpeg";
            } else if($_FILES['image']['type'] == "image/png") {
                $saveTo = $user . ".png";
            } else {
                $typeOK = FALSE;
                $error = "Unsupported image format: gif, jpeg or png!";
            }

            // uploading image 
            if($typeOK) {
                move_uploaded_file($_FILES['image']['tmp_name'], $saveTo);
                update_profile_picture($saveTo, $user);
                $success = "Your profile has been successfully updated.";
                $profile_picture = $saveTo; //updating $profile_picture variable 
            }

        } else {
            $error = "Error while uploading file";
        }
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
        <?php include "menu.php"; ?>

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