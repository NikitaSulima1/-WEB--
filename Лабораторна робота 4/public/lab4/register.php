<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("
            INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password)
        ");

        $stmt->execute([
            ":username" => $username,
            ":email" => $email,
            ":password" => $hashedPassword
        ]);

        echo "Реєстрація успішна. <a href='login.html'>Увійти</a>";

    } catch (PDOException $e) {
        echo "Помилка: " . $e->getMessage();
    }
}
?>
