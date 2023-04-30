<?php
session_start();
require "../functions/helpers.php";
require "../functions/pdo_connection.php";
global $db;
$errors = array();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}
if (isset($_POST['email']) && !(empty($_POST['email'])) && isset($_POST['password']) && !(empty($_POST['password']))) {
    $sql = "SELECT * FROM users WHERE email = ? ";
    $statment = $db->prepare($sql);
    $statment->execute([$_POST['email']]);
    $user = $statment->fetch();
    if ($user !== false) {
        if (password_verify($_POST['password'], $user->password)) {
            $_SESSION['user'] = $user->email;
            redirect("panel");
        } else {
            $errors[] = "password is incorrect";
        }
    } else {
        $errors[] = "This user does not exist";
    }
} else {
    if (isset($_POST['submit'])) {
        $errors[] = "Enter your email address or password";
    }
}
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

        <section style="height: 100vh; background-color: #138496;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">PHP Tutorial login</h1>
                <section class="bg-light my-0 px-2">
                    <?php if (isset($errors)) : ?>
                        <?php foreach ($errors as $error) : ?>
                            <small class="text-danger"><?= $error ?></small>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action="<?= url("auth/login.php") ?>" method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ...">
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input type="submit" name="submit" class="btn btn-success btn-sm" value="login">
                        <a class="" href="<?= url("auth/register.php") ?>">register</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('js/jquery.min.js') ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js') ?>"></script>
</body>

</html>