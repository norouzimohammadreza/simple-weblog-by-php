<?php
require_once '../../functions/db_config.php';
require_once('../../functions/helpers.php');
require_once '../../functions/chk-login.php';
if(!isset($_REQUEST['post_id'])){
redirect('panel/post');
}
$sql = 'SELECT * FROM posts WHERE id = ?';
$stmt = $connection->prepare($sql);
$stmt->execute([$_REQUEST['post_id']]);
$post = $stmt->fetch(); 
if($post===false)
{
    redirect('panel/post');
}
if(isset($_POST['update'])){
if(
    (isset($_REQUEST['title'])&& $_REQUEST['title'] !== '')
&& (isset($_REQUEST['cat_id'])&& $_REQUEST['cat_id'] !== '')
&& (isset($_REQUEST['body'])&& $_REQUEST['body'] !== '')
){
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        
    
    $alowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMimes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if (!in_array($imageMimes, $alowedMimes)) {
        redirect('panel/post');
    }
    $basePath = dirname(dirname(__DIR__));
    if (file_exists($basePath . $post->image)) {
        unlink($basePath . $post->image);
        $image = '/assets/images/posts/'. date('Y_m_d_H_i_s') . '.' . $imageMimes;
        $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
    }
    if ($image_upload !== false) {
        $sql = "UPDATE posts SET title =:title ,image=:image,body=:body,cat_id=:cat_id,update_time=NOW() WHERE id=:id ";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $_GET['post_id']);
        $stmt->bindParam(':title', $_POST['title']);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':body', $_POST['body']);
        $stmt->bindParam(':cat_id', $_POST['cat_id']);
        $stmt->execute();
        
    }
}else{
    $sql = "UPDATE posts SET title =:title ,body=:body,cat_id=:cat_id,update_time=NOW() WHERE id=:id ";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id', $_GET['post_id']);
    $stmt->bindParam(':title', $_POST['title']);
    $stmt->bindParam(':body', $_POST['body']);
    $stmt->bindParam(':cat_id', $_POST['cat_id']);
    $stmt->execute();
    
}
redirect('panel/post');

}}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
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

                    <form action="<?= url('panel/post/edit.php?post_id=' . $_GET['post_id']); ?>" method="post"
                        enctype="multipart/form-data">
                        <section class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $post->title ?>">
                        </section>
                        <section class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </section>
                        <section class="form-group">
                            <label for="cat_id">Category</label>
                            <select class="form-control" name="cat_id" id="cat_id">
                                <?php
                            $sql = "SELECT * FROM categories";
                            $stmt = $connection->prepare($sql);
                            $stmt->execute();
                            $results = $stmt->fetchAll();
                            foreach ($results as $result) { ?>
                                <option value="<?= $result->id; ?>"
                                    <?php if($post->cat_id == $result->id) echo"selected"; ?>><?= $result->title; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </section>
                        <section class="form-group">
                            <label for="body">Body</label>
                            <textarea class="form-control" name="body" id="body" rows="5"><?= $post->body ?></textarea>
                        </section>
                        <section class="form-group">
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
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