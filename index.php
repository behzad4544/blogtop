<?php
require "functions/helpers.php";
require "functions/pdo_connection.php";
global $db;
$sql = "SELECT posts.*, categories.name AS catName FROM posts left join categories on posts.cat_id = categories.id where status = ?";
$statment = $db->prepare($sql);
$statment->execute([10]);
$posts = $statment->fetchAll();
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.min.css") ?>" type="text/css">
</head>

<body>
    <section id="app">
        <?php require_once "layouts/top-nav.php" ?>


        <section class="container my-5">
            <!-- Example row of columns -->
            <section class="row">
                <?php foreach ($posts as $post) : ?>

                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid" src="<?= pic($post->image) ?>" alt=""></section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= $post->body ?></p>
                        <p><a class="btn btn-primary" href="<?= url("detail.php") . "?id=" . $post->id ?>" role="button">View
                                details »</a></p>
                    </section>
                <?php endforeach; ?>

            </section>
        </section>
    </section>
    <script src="<?= asset("js/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.min.js") ?>"></script>
</body>

</html>