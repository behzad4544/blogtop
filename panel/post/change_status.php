<?php
require "../../functions/helpers.php";
require "../../functions/check-login.php";
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
    if ($post->status == 10) {
        $status = 0;
        $sql = "UPDATE posts SET status = ? WHERE id = ?";
        $statment = $db->prepare($sql);
        $statment->execute([$status, $id]);
    } else {
        $status = 10;
        $sql = "UPDATE posts SET status = ? WHERE id = ?";
        $statment = $db->prepare($sql);
        $statment->execute([$status, $id]);
    }
    redirect("panel/post");
}
