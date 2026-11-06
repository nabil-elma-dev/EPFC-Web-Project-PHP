<?php
    session_start();
    

    function connect() {
        $dbhost = "localhost";
        $dbname = "my_social_network_base";
        $dbuser = "root";
        $dbpassword = "";
        try {
            $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $exc) {
            abort("Connexion failed: " . $exc);
        }   
        return $pdo;
    }
    
    $pdo_object = connect();
    
    function escape($var) {
        return htmlspecialchars((string) $var, ENT_QUOTES, "UTF-8");
    }

    function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    function check_login() {
        global $user;
        if (!isset($_SESSION['user'])) {
            redirect('index.php');
        } else {
            $user = $_SESSION['user'];
        }
    }

    function abort($err) {
        global $error;
        $error = $err;
        include 'error.php';
        die;
    }

// Sign-up functions    
    function is_pseudo_available($pseudo) {
        global $pdo_object;
        try {
            $query = $pdo_object->prepare("SELECT 1 FROM Members WHERE pseudo = :pseudo");
            $query->execute(["pseudo" => $pseudo]);
            $memberRecord = $query->fetch();
            return $memberRecord;
        } catch (Exception $e) {
            abort($e);
        }
    }

    function insert_user($pseudo, $password) {
        global $pdo_object;
        try {
            // hashing password and inserting print
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $query = $pdo_object->prepare("INSERT INTO Members (pseudo, password) VALUES (:pseudo, :password_hash)");
            $query->execute(["pseudo" => $pseudo, "password_hash" => $hash]);
            session_regenerate_id(true);
            $_SESSION["user"] = $pseudo;
            redirect("profile.php");
        } catch (Exception $e) {
            abort($e);
        }
    }

// Member functions
    function get_members() {
        global $pdo_object;

        try {
            $query = $pdo_object->prepare("SELECT pseudo FROM Members");
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $exc) {
            abort($e);
        }
    }

// Edit_profile functions
    function update_profile_description($new_profile_description, $pseudo) {
        global $pdo_object;
        try {
            $query = $pdo_object->prepare("UPDATE Members SET profile = :profile WHERE pseudo = :pseudo");
            $query->execute(["profile" => $new_profile_description, "pseudo" => $pseudo]);
        } catch (Exception $e) {
            abort($e);
        };
    }

    function update_profile_picture($saveTo, $user) {
        global $pdo_object;
        try{
            $query = $pdo_object->prepare("UPDATE Members SET picture_path = :path WHERE pseudo = :pseudo");
            $query->execute(["path" => $saveTo, "pseudo" => $user]);
        } catch (Exception $e) {
            abort($e);
        }
    }

// Login && profile && edit_profile functions
    function get_member_by_pseudo($pseudo) {
        global $pdo_object;
        try {
            $query = $pdo_object->prepare("SELECT * FROM Members WHERE pseudo = :pseudo");
            $query->execute(["pseudo" => $pseudo]);
            return $query->fetch();
        }
        catch (Exception $exc) {
            abort($e);
        }
    }
?>