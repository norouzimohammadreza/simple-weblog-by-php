<?php
require_once '../../functions/db_config.php' ;
require_once('../../functions/helpers.php');
if ((isset($_REQUEST['catid']))&&$_GET['catid']!='') {
    $sql = "DELETE FROM categories WHERE id=:id";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':id',$_GET['catid']);
    $stmt->execute();

}
redirect('panel/category');