<?php
global $db;
try {
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $db = new PDO("mysql:host=localhost;dbname=php_project", 'root', 'root', $options);
    return $db;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
