<?php
require_once 'functions/db_config.php';
require_once('functions/helpers.php');
$sql = 'SELECT * FROM categories WHERE id=:id';
$stmt = $connection->prepare($sql);
$stmt->bindParam(':id', $_REQUEST['cat_id']);
$stmt->execute();
$cat = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if ($cat !== false) echo $cat->title;
            else echo 'Not Category Found'; ?></title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">
        <?php require_once "layout/head-nav.php" ?>
        <section class="container my-5">
            <?php if (isset($_GET['cat_id']) && ($_GET['cat_id'] == $cat->id) ) {
                $sql = 'SELECT * FROM posts WHERE cat_id=:cat_id';
                $stmt = $connection->prepare($sql);
                $stmt->bindParam(':cat_id', $_GET['cat_id']);
                $stmt->execute();
                $posts = $stmt->fetchAll();
            ?>
                <section class="row">
                    <section class="col-12">
                        <h1><?= $cat->title ?></h1>
                        <hr>
                    </section>
                </section>
                <section class="row">
                <?php if(!empty($posts)){
                    foreach ($posts as $post) { ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;">
                        <img class="img-fluid" src="<?= asset($post->image); ?>" alt="">
                    </section>
                        <h2 class="h5 text-truncate"><?= $post->title ?></h2>
                        <p><?= substr($post->body,0,28)." ...";  ?></p>
                        <p><a class="btn btn-primary" href="<?= url('post.php?post_id='.$post->id); ?>" role="button">View details »</a></p>
                    </section>
                    <?php } } else {?>
                        <section class="row">
                    <section class="col-12">
                        <h1>Category no post</h1>
                    </section>
                </section>
                        <?php } ?>
                </section>
            <?php } else { ?>
                <section class="row">
                    <section class="col-12">
                        <h1>Category not found</h1>
                    </section>
                </section>
            <?php } ?>
        </section>
    </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>