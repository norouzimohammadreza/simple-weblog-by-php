<?php 
//config

define('BASE_URL', 'http://localhost/projects/Weblog/');

function redirect($url) 
 {
    header('Location : '. trim(BASE_URL,'/'). '/'. trim($url,'/'));
}
function asset($file) 
 {
   return trim(BASE_URL,'/'). '/'. trim($file,'/');
}
echo asset('/assets/css/style.css/');




?>