<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("
        SELECT * FROM users WHERE username = :username
    ");

    $stmt->execute([
        ":username" => $username
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user"] = $user["username"];

        header("Location: welcome.php");
        exit;

    } else {
        echo "Невірний логін або пароль";
    }
}
?>
