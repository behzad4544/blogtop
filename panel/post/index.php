<?php
require "../../functions/helpers.php";
require "../../functions/check-login.php";
require "../../functions/pdo_connection.php";
global $db;
$sql = "SELECT posts.*, categories.name AS catName FROM `posts` LEFT JOIN `categories` ON posts.cat_id = categories.id";
$statement = $db->prepare($sql);
$statement->execute();
$posts = $statement->fetchAll();
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
        <?php require "../layouts/top-nav.php" ?>
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require "../layouts/sidebar.php" ?>
                </section>
                <section class="col-md-10 pt-3">
                    <section class="mb-2 d-flex justify-content-between align-items-center">
                        <h2 class="h4">Articles</h2>
                        <a href="<?= url("panel/post/create.php") ?>" class="btn btn-sm btn-success">Create</a>
                    </section>

                    <section class="table-responsive">
                        <table class="table table-striped table-">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>image</th>
                                    <th>title</th>
                                    <th>cat_Name</th>
                                    <th>body</th>
                                    <th>status</th>
                                    <th>setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($posts as $post) : ?>
                                    <tr>
                                        <td><?= $post->id ?></td>
                                        <td><img style="width: 90px;" src="<?= asset("images/posts/") . "/" . $post->image ?>">
                                        </td>
                                        <td><?= $post->title ?></td>
                                        <td><?= $post->catName ?></td>
                                        <td><?= substr($post->body, 0, 30) . " ..." ?></td>
                                        <td><span class="text-success"><?= ($post->status == "10") ? "enable" : "" ?></span>
                                            <span class="text-danger"><?= ($post->status != "10") ? "disable" : "" ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= url("panel/post/change_status.php?id=") . $post->id  ?>" class="btn btn-warning btn-sm">Change status</a>
                                            <a href="<?= url("panel/post/edit.php?id=") . $post->id  ?>" class="btn btn-info btn-sm">Edit</a>
                                            <a href="<?= url("panel/post/delete.php?id=") . $post->id  ?>" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                </section>
            </section>
        </section>
    </section>
    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>

</html>