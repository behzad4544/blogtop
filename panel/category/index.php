<?php
require "../../functions/helpers.php";
require "../../functions/pdo_connection.php";
global $db;
$sql = "SELECT * FROM `categories`";
$statement = $db->prepare($sql);
$statement->execute();
$categories = $statement->fetchAll();
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
        <?php require "../layouts/top-nav.php"; ?>
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require "../layouts/sidebar.php"; ?>
                </section>
                <section class="col-md-10 pt-3">

                    <section class="mb-2 d-flex justify-content-between align-items-center">
                        <h2 class="h4">Categories</h2>
                        <a href="<?= url("panel/category/create.php") ?>" class="btn btn-sm btn-success">Create</a>
                    </section>

                    <section class="table-responsive">
                        <table class="table table-striped table-">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>name</th>
                                    <th>setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($categories as $category) : ?>
                                    <tr>
                                        <td><?= $category->id ?></td>
                                        <td><?= $category->name ?></td>
                                        <td>
                                            <a href="<?= url("panel/category/edit.php") ?>?id=<?= $category->id ?>" class="btn btn-info btn-sm">Edit</a>
                                            <a href="<?= url("panel/category/delete.php") ?>?id=<?= $category->id ?>" class="btn btn-danger btn-sm">Delete</a>
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