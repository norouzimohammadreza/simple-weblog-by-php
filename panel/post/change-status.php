<?php
require_once '../../functions/db_config.php';
require_once('../../functions/helpers.php');
if (isset($_GET['post_id'])&& $_GET['post_id']!='') {
    $sql = "SELECT * FROM posts";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $post = $stmt->fetch();
    if($post!==false){
    $status = ($post->status == 1)? 0 : 1;
    $sql = "UPDATE posts SET status=:status WHERE id=:id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id',$_GET['post_id']);
    $stmt->bindParam(':status',$status);
    $stmt->execute();
}
}
redirect('panel/post');


