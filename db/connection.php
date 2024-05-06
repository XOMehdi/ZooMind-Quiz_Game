<?php
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'zoomind');
define('HOST', 'localhost');

try {
    $conn = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database Connection Failed: " . $e->getMessage();
}
