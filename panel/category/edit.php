<?php
require "../../functions/helpers.php";
require "../../functions/check-login.php";
require "../../functions/pdo_connection.php";
if (!($_GET['id']) && !(isset($_GET['id']))) {
    redirect("panel/category/");
} else {
    $id = $_GET['id'];
    global $db;
    $sql1 = "SELECT * FROM `categories` WHERE `id` =?";
    $statment = $db->prepare($sql1);
    $statment->execute([$id]);
    $res = $statment->fetch();
    if ($res === false) {
        redirect("panel/category/");
    }
    if (isset($_POST['name']) && $_POST['name'] != "") {
        $newName = $_POST['name'];
        $sql = "UPDATE `categories` SET `name`=?,`updated_at`=NOW() WHERE `id`=?;";
        $statment2 = $db->prepare($sql);
        $statment2->execute([$newName, $id]);
        redirect("panel/category/");
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
        <?php require "../layouts/top-nav.php"; ?>

        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require "../layouts/sidebar.php"; ?>
                </section>
                <section class="col-md-10 pt-3">
                    <form action="<?= url("panel/category/edit.php?id=") . $res->id ?>" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ..." value='<?= $res->name ?>'>
                        </section>
                        <section class=" form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </section>
                    </form>

                </section>
            </section>
        </section>

    </section>


    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>

</html>