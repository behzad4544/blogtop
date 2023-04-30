<?php
require "../../functions/helpers.php";
require "../../functions/check-login.php";
require "../../functions/pdo_connection.php";

if (!($_GET['id']) && !(isset($_GET['id']))) {
    redirect("panel/category/");
} else {
    $id = $_GET['id'];
    global $db;
    $sql = "DELETE FROM `categories` WHERE `id`=?";
    $statment = $db->prepare($sql);
    $statment->execute([$id]);
    redirect("panel/category/");
}
