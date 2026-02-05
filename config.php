<?php
// config.php - Database configuration
$host = 'localhost';
$dbname = 'chakula_fasta';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Don't show error to users in production
    error_log("Database connection failed: " . $e->getMessage());
    // You can show a friendly message instead
    die("Database connection error. Please try again later.");
}
?>