<?php
$host     = getenv('MYSQL_HOST')     ?: 'db';
$dbname   = getenv('MYSQL_DATABASE') ?: 'blog';
$username = getenv('MYSQL_USER')     ?: 'bloguser';
$password = getenv('MYSQL_PASSWORD') ?: '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}