<?php
define('BASE_URL', 'http://localhost:8010/blogtop/');
function redirect($path)
{
    header("Location:" . trim(BASE_URL, '/ ') . "/" . trim($path, '/ '));
    exit;
}
function asset($file)
{
    return trim(BASE_URL, '/ ') . '/' . "assets/" .  trim($file, '/ ');
}
function pic($file)
{
    return trim(BASE_URL, '/ ') . '/' . "assets/images/posts/" .  trim($file, '/ ');
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
