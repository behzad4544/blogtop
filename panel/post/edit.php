<?php
require "../../functions/helpers.php";
require "../../functions/pdo_connection.php";
global $db;
if (!isset($_GET['id']) && $_GET['id'] == "") {
    redirect("panel/post/");
}
$query = "SELECT * FROM posts WHERE id = ?";
$statem = $db->prepare($query);
$statem->execute([$_GET['id']]);
$pos = $statem->fetch();
if ($pos === false) {
    redirect("panel/post/");
}
$sql1 = "SELECT * FROM `categories`";
$statment1 = $db->prepare($sql1);
$statment1->execute();
$categories = $statment1->fetchAll();
$id = $_GET['id'];
$sql = "SELECT posts.*,categories.name AS catName FROM posts LEFT JOIN categories ON posts.cat_id =categories.id where posts.id = ?";
$statement = $db->prepare($sql);
$statement->execute([$id]);
$posts = $statement->fetch();
if (isset($_POST['submit']) && isset($_POST['title']) && !(empty($_POST['title'])) && isset($_POST['cat_id']) && !(empty($_POST['cat_id'])) && isset($_POST['body']) && !(empty($_POST['body']))) {
    $title = $_POST['title'];
    $cat_id = $_POST['cat_id'];
    $sql1 = "SELECT * FROM `categories` where id = ?";
    $statment1 = $db->prepare($sql1);
    $statment1->execute([$cat_id]);
    $catt = $statment1->fetch();
    $body = $_POST['body'];
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $ext = explode(".", $_FILES['image']['name']);
        $ext = $ext[count($ext) - 1];
        $oldFileName = $_FILES['image']['name'];
        $NewFileName = md5($oldFileName . time()) . "." . $ext;
        $allowExt = ["jpg", "png", "jpeg"];
        $tmp = $_FILES['image']['tmp_name'];
        $allowSize = 5 * 1024 * 1024;
        $dis = "C:\\xampp\htdocs\blogtop\assets\images\posts\\" . $NewFileName;
        if (in_array($ext, $allowExt) && $_FILES['image']['size'] < $allowSize && $_FILES['image']['size'] > 0) {
            $move = move_uploaded_file($tmp, $dis);
            $image = $NewFileName;
            unlink("C:\\xampp\htdocs\blogtop\assets\images\posts\\" . $posts->image);
        }
    } else {
        $image = $posts->image;
    }
    if ($move != false && $catt != false) {
        $sql3 = "UPDATE posts SET title = ?,body = ?,cat_id = ?,image = ?,updated_at=NOW() WHERE id = ?";
        $statment4 = $db->prepare($sql3);
        $statment4->execute([$title, $body, $cat_id, $image, $posts->id]);
        redirect("panel/post/");
    }
    redirect("panel/post/");
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
                    <?php require "../layouts/sidebar.php" ?>
                </section>
                <section class="col-md-10 pt-3">

                    <form action="<?= url("panel/post/edit.php?id=") . $posts->id ?>" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $posts->title ?>">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                            <img style="width: 90px;" src="<?= asset("/images/posts/") . "/" . $posts->image ?>">
                        </section>
                        <section class="form-group">
                            <label for="cat_id">Category</label>
                            <select class="form-control" name="cat_id" id="cat_id">
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category->id ?>" <?php if ($category->name == $posts->catName) {
                                                                                echo "selected";
                                                                            }  ?>>
                                        <?= $category->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."><?= $posts->body ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
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