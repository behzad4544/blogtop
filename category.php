<?php
require "functions/helpers.php";
require "functions/pdo_connection.php";
global $db;
$sql = "SELECT posts.*,categories.name AS catName FROM posts JOIN categories ON posts.cat_id = categories.id WHERE posts.status= 10 AND posts.cat_id = ?";
$statment = $db->prepare($sql);
$statment->execute([$_GET['cat_id']]);
$posts = $statment->fetchAll();
// dd($posts);
$sql = "SELECT * FROM categories WHERE id = ?";
$statment = $db->prepare($sql);
$statment->execute([$_GET['cat_id']]);
$cat = $statment->fetch();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.min.css") ?>" type="text/css">
</head>

<body>
    <section id="app">
        <?php require_once "layouts/top-nav.php" ?>

        <section class="container my-5">

            <section class="row">
                <section class="col-12">
                    <h1><?= $cat->name ?></h1>
                    <hr>
                </section>
            </section>
            <section class="row">
                <?php if ($post !== false) : ?>
                <?php foreach ($posts as $post) : ?>
                <section class="col-md-4">
                    <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid"
                            src="<?= pic($post->image) ?>" alt=""></section>
                    <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                    <p><?= substr($post->body, 0, 20) ?></p>
                    <p><a class="btn btn-primary" href="<?= url("detail.php") . "?id=" . $post->id ?>"
                            role="button">View details »</a></p>
                </section>
                <?php endforeach; ?>
                <?php endif; ?>
            </section>
            <section class="row">
                <?php if ($post !== true) : ?>
                <section class="col-12">
                    <h1>Category not found</h1>
                </section>
                <?php endif; ?>

            </section>

        </section>
    </section>

    </section>
    <script src="<?= asset("js/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.min.js") ?>"></script>
</body>

</html>