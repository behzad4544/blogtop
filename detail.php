<?php
require "functions/helpers.php";
require "functions/pdo_connection.php";
global $db;
if (!isset($_GET['id']) && empty($_GET['id'])) {
    redirect("index.php");
}
$sql = "SELECT posts.*,categories.name AS catName FROM posts JOIN categories ON posts.cat_id = categories.id WHERE posts.status= 10 AND posts.id = ?";
$statment = $db->prepare($sql);
$statment->execute([$_GET['id']]);
$post = $statment->fetch();

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
            <!-- Example row of columns -->
            <section class="row">
                <?php if ($post == true) : ?>
                    <section class="col-md-12">
                        <h1><?= $post->title ?></h1>
                        <h5 class="d-flex justify-content-between align-items-center">
                            <a href="<?= url("category.php") . "?cat_id=" . $post->cat_id  ?>"><?= $post->catName ?></a>
                            <span class="date-time"><?= $post->created_at ?></span>
                        </h5>
                        <article class="bg-article p-3"><img class="float-right mb-2 ml-2" style="width: 18rem;" src="<?= pic($post->image) ?>" alt=""><?= $post->body ?></article>
                    <?php endif; ?>

                    <?php if ($post === false) : ?>

                        <section>post not found!</section>
                    <?php endif; ?>
                    </section>
            </section>
        </section>

    </section>
    <script src="<?= asset("js/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.min.js") ?>"></script>
</body>

</html>