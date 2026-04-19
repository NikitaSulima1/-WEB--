<?php
$host = "postgres";
$dbname = "users_db";
$user = "laravel-getting-started-user";
$pass = "laravel-getting-started-password";

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Підключення до бази даних успішне";

} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
?>
