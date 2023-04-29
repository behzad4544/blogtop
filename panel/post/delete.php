<?php
require "../../functions/helpers.php";
require "../../functions/pdo_connection.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    redirect("panel/post");
}
global $db;
$id = $_GET['id'];
$sql = "SELECT * FROM posts WHERE id =?";
$statement = $db->prepare($sql);
$statement->execute([$id]);
$post = $statement->fetch();
if ($post == false) {
    redirect("panel/post");
} else {
    $sql = "DELETE FROM posts WHERE id =?";
    $statement = $db->prepare($sql);
    $statement->execute([$id]);
    if (file_exists("/var/www/html/blogtop/assets/images/posts/"  . $post->image)) {
        unlink("/var/www/html/blogtop/assets/images/posts/"  . $post->image);
    }
}
redirect("panel/post");
