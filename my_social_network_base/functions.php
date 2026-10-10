<?php
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