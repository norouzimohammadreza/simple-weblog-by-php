<?php
require_once 'functions/db_config.php';
require_once('functions/helpers.php');

$sql = 'SELECT posts.* , categories.title AS cat_name FROM posts LEFT JOIN categories 
ON posts.cat_id = categories.id WHERE posts.status = 1 AND posts.id=:id;';
$stmt = $connection->prepare($sql);
$stmt->bindParam(':id', $_REQUEST['post_id']);
$stmt->execute();
$post = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if($post!==false) echo $post->title;else echo "Not Found 404";?></title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">
    <?php 
    require_once "layout/head-nav.php" ?>
        <section class="container my-5">
            <!-- Example row of columns -->
            <section class="row">
                <section class="col-md-12">
                    <?php if($post!==false){ ?>
                    <h1><?= $post->title ?></h1>
                    <h5 class="d-flex justify-content-between align-items-center">
                        <a href="<?= url('category.php?cat_id='.$post->cat_id); ?>"><?= $post->cat_name ?></a>
                        <span class="date-time"><?= $post->created_time ?></span>
                    </h5>
                   
                    <section class="mb-2 overflow-hidden" style="max-height: 15rem;max-width:15rem ; ">
                        <img class="img-fluid" src="<?= asset($post->image); ?>" alt="">
                    </section>
                    <article class="bg-article p-3">
                        <img class="float-right mb-2 ml-2" style="width: 18rem;" src="" alt="">
                        <?= $post->body ?>
                    </article>
                        <?php }else{ ?>
                    <section>post not found!</section>
                            <?php } ?>
                </section>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>