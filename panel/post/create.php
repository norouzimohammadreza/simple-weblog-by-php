<?php
require_once '../../functions/db_config.php';
require_once('../../functions/helpers.php');
$sql = "SELECT * FROM categories";
$stmt = $connection->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();
if (isset($_REQUEST['create'])) {
    if (
        (isset($_REQUEST['title']) && $_POST['title'] != '')
        && (isset($_FILES['image']) && $_FILES['image']['name'] != '')
        && (isset($_REQUEST['cat_id']) && $_POST['cat_id'] != '')
        && (isset($_REQUEST['body']) && $_POST['body'] != '')
    ) {

        $alowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
        $imageMimes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if (!in_array($imageMimes, $alowedMimes)) {
            redirect('panel/post');
        }
        $basePath = dirname(dirname(__DIR__));
        $image = '/assets/images/posts/'. date('Y_m_d_H_i_s') . '.' . $imageMimes;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
        if ($image_upload !== false) {
            $sql = "INSERT INTO posts(title,image,body,cat_id) VALUES (:title,:image,:body,:cat_id)";
            $stmt = $connection->prepare($sql);
            $stmt->bindParam(':title', $_POST['title']);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':body', $_POST['body']);
            $stmt->bindParam(':cat_id', $_POST['cat_id']);
            $stmt->execute();
           
        }
        redirect('panel/post');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
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

                    <form action="<?= url('panel/post/create.php'); ?>" method="post" enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="title ...">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </section>
                        <section class="form-group">
                            <label for="cat_id">Category</label>
                            <select class="form-control" name="cat_id" id="cat_id">
                                <?php foreach ($results as $result) { ?>
                                    <option value="<?= $result->id; ?>"><?= $result->title; ?></option>
                                <?php } ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" name="create" class="btn btn-primary">Create</button>
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