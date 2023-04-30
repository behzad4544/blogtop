<?php
session_start();
require "../functions/helpers.php";
if (isset($_SESSION['user'])) {
    session_destroy();
}
redirect("auth/login.php");
