<?php
define('BASE_URL', 'http://localhost/blogtop/');
function redirect($path)
{
    header("Location:" . trim(BASE_URL, '/ ') . "/" . trim($path, '/ '));
    exit;
}
function asset($file)
{
    return trim(BASE_URL, '/ ') . '/' . "assets/" .  trim($file, '/ ');
}
function dd($var)
{
    echo "<pre>";
    var_dump($var);
    exit;
}
