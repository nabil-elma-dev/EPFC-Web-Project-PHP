<?php
session_start();
$dbhost = "localhost";
$dbname = "my_social_network_base";
$dbuser = "root";
$dbpassword = "";


try
{
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $exc)
{
    die("Error while accessing database. Please contact your administrator.");
}

function escape($string) {
    return htmlspecialchars((string)$string, ENT_QUOTES, 'UTF-8');
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

function insert_new_member($pseudo, $password) {
    try {
        $query = $pdo->prepare("INSERT INTO Members (pseudo, password) VALUES (:pseudo, :password)");
        $query->execute(["pseudo" => $pseudo, "password" => $password]);
    } catch (Exception $e) {
        die("Error while accessing database. Please contact your administrator.");
    }
}