<?php
global $connection;
try {
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $connection = new PDO("mysql:host=localhost;dbname=php_project", 'root', 'root', $options);
    return $connection;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
