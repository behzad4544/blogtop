<?php
require "../functions/helpers.php";
require "../functions/check-login.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>" type="text/css">
    <link rel="stylesheet" href="<?= asset("css/bootstrap.min.css") ?>" type="text/css">
    <title>PHP panel</title>
</head>

<body>
    <section id="app">
        <?php require "./layouts/top-nav.php" ?>
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php require "./layouts/sidebar.php" ?>
                </section>
                <section class="col-md-10 pb-3">

                    <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                        <section>
                            <h1>PHP Tutorial</h1>
                            <ul class="mt-2 li">
                                <li>
                                    <h3>PDO Connection</h3>
                                </li>
                                <li>
                                    <h3>File upload</h3>
                                </li>
                                <li>
                                    <h3>Blog (categories and posts)</h3>
                                </li>
                            </ul>
                        </section>
                    </section>

                </section>
            </section>
        </section>


    </section>

    <script src="<?= asset("js/bootstrap.min.js") ?>"></script>
    <script src="<?= asset("js/jquery.min.js") ?>"></script>
</body>

</html>