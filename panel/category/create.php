<?php
require "../../functions/helpers.php";
require "../../functions/check-login.php";
require "../../functions/pdo_connection.php";
global $db;
$errors = [];
if (isset($_POST['submit']) && isset($_POST['name']) && !(empty($_POST['name']))) {
    if (strlen($_POST['name']) > 3) {
        $name = $_POST['name'];
        $sql = "INSERT INTO `categories` SET name = ?";
        $statment = $db->prepare($sql);
        $statment->execute([$name]);
        redirect("panel/category/");
    } else {
        $errors[] = "Invalid name provided";
    }
}

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
                    <?php require "../layouts/sidebar.php"; ?>
                </section>
                <section class="col-md-10 pt-3">

                    <form action="create.php" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                        </section>
                        <section class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Create</button>
                        </section>

                    </form>
                    <?php foreach ($errors as $error) {
                        echo $error;
                    }
                    ?>
                </section>
            </section>
        </section>

    </section>

    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>

</html>