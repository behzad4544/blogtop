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
function url($url)
{
    return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
}
function dd($var)
{
    echo "<pre>";
    var_dump($var);
    exit;
}
