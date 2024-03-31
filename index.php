<?php
session_start();
require_once 'functions/db_config.php';
require_once('functions/helpers.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Weblog</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <?php require_once "layout/head-nav.php" ?>

        <section class="container my-5">
            <!-- Example row of columns -->
            <section class="row">
                <?php
                $sql = 'SELECT posts.* , categories.title AS cat_name FROM posts LEFT JOIN categories 
            ON posts.cat_id = categories.id WHERE posts.status = 1';
                $stmt = $connection->prepare($sql);
                $stmt->execute();
                $posts = $stmt->fetchAll();

                foreach ($posts as $post) { ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;"><img class="img-fluid" src="<?= asset($post->image); ?>" alt=""></section>
                        <h2 class="h5 text-truncate"><?= $post->title; ?></h2>
                        <p><?= $post->cat_name; ?></p>
                        <p><a class="btn btn-primary" href="<?= url('post.php?post_id='). $post->id ?>" role="button">View details »</a></p>
                    </section>
                <?php } ?>
            </section>
        </section>

    </section>

    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>