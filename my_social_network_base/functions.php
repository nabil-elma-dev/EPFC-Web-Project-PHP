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

    function is_pseudo_available($pseudo) {
        $pdo = connect();
        try {
            $query = $pdo->prepare("SELECT 1 FROM Members WHERE pseudo = :pseudo");
            $query->execute(["pseudo" => $pseudo]);
            $memberRecord = $query->fetch();
            return $memberRecord;
        } catch (Exception $e) {
            abort($e);
        }
    }

    function insert_user($pseudo, $password) {
        $pdo = connect();
        try {
            // hashing password and inserting print
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $query = $pdo->prepare("INSERT INTO Members (pseudo, password) VALUES (:pseudo, :password_hash)");
            $query->execute(["pseudo" => $pseudo, "password_hash" => $hash]);
            session_regenerate_id(true);
            $_SESSION["user"] = $pseudo;
            redirect("profile.php");
        } catch (Exception $e) {
            abort($e);
        }
    }
?>