<?php
$host = 'localhost';
$db   = 'rsk0_rsk0277_2';
$user = 'rsk0_rsk0277_2';
$pass = '654321#';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // If connection fails, stop everything and show a clean error message
     die("<h3>Website Connection Error</h3><p>Could not connect to the database. Please check your internet connection or server status.</p><p>Error: " . $e->getMessage() . "</p>");
}
?>
