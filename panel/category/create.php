<?php
require('../../functions/helpers.php');
require_once '../../functions/db_config.php';
require_once '../../functions/chk-login.php';
if ((isset($_POST['create'])) && $_POST['name'] != "") {
    $sql = "INSERT INTO categories(title)VALUES(:title)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':title',$_POST['name']);
    $stmt->execute();
    redirect('panel/category');

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Category</title>
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

                    <form action="<?= url('panel/category/create.php'); ?>" method="post">
                        <section class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ...">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-primary" name="create">Create</button>
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