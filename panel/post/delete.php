<?php
require_once '../../functions/db_config.php';
require_once('../../functions/helpers.php');
require_once '../../functions/chk-login.php';
if(isset($_GET['post_id'])&& $_GET['post_id']!=''){
    $sql = "DELETE FROM posts WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$_GET['post_id']]);
}
redirect('panel/post');