<?php
session_start();

require_once('../functions/helpers.php');
require_once '../functions/db_config.php';
$error = '';
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
}
if(isset($_POST['login'])){
if(
    (isset($_POST['email']) && $_POST['email'] !== '')
    && (isset($_POST['password']) && $_POST['password'] !== '')
){
    $sql = 'SELECT * FROM users WHERE email=?';
    $stmt = $connection->prepare($sql);
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();
    if($user !== false){
        
       if($user->password === $_POST['password']){
       $_SESSION['user']=$user->email;
       redirect('panel');
       }else{
        $error = 'The password is not correct';
       }
    }else{
        $error = 'The email is not valid';
    }
}else{
    $error = "Please fill in all the values.";
}}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background-color: #138496;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">login</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger"><?php if($error!=='') echo $error;  ?></small>
                </section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action="<?php url('auth/login.php'); ?>" method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ...">
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input type="submit" name="login" class="btn btn-success btn-sm" value="login">
                        <a class="" href="">register</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>