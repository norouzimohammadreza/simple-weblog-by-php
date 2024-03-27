<?php
require('../../functions/helpers.php');
require_once '../../functions/db_config.php';
$sql = "SELECT title FROM categories WHERE id=:id";
$stmt = $connection->prepare($sql);
$getId=$_GET['catid'];
$stmt->bindParam(':id',$getId);
$stmt->execute();
global $title;
$result = $stmt->fetch();
if(!isset($_GET['catid'])){
    redirect('panel/category');
}

if ((isset($_POST['update'])) && $_POST['name'] != "") {
    $sql = "UPDATE categories SET title=:title , update_time=NOW() WHERE id=:id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':title',$_POST['name']);
    $stmt->bindParam(':id',$getId);
    $stmt->execute();
    redirect('panel/category');

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Category</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">
        <?php
        require_once('../layout/header.php');
        ?>
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <?php
                    require_once('../layout/side-nav.php');
                    ?>
                </section>
                <section class="col-md-10 pt-3">
                    <form action="<?= url('panel/category/edit.php?catid='.$_GET['catid']); ?>" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?=$result->title?>">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary" name="update">Update</button>
                        </section>

                    </form>

                </section>
            </section>
        </section>

    </section>

    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>