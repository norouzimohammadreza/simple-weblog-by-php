<?php
require_once('../functions/helpers.php');
require_once '../functions/db_config.php';

$error = '';
if (isset($_POST['submit'])) {

    if (
        (isset($_POST['email']) && $_POST['email'] !== '')
        && (isset($_POST['first_name']) && $_POST['first_name'] !== '')
        && (isset($_POST['last_name']) && $_POST['last_name'] !== '')
        && (isset($_POST['password']) && $_POST['password'] !== '')
        && (isset($_POST['repassword']) && $_POST['repassword'] !== '')
    ) {
        if ($_POST['repassword'] === $_POST['password']) {

            if (strlen($_POST['password']) > 5) {

                $sql = "SELECT * FROM users WHERE email = :email";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->execute();
                $user = $stmt->fetch();

                if ($user === false) {
                    $sql = 'INSERT INTO users (email,first_name,last_name,password) VALUES (:email,:first_name,:last_name,:password)';
                    $stmt = $connection->prepare($sql);
                    $stmt->bindParam(':email', $_POST['email']);
                    $stmt->bindParam(':first_name', $_POST['first_name']);
                    $stmt->bindParam(':last_name', $_POST['last_name']);
                    $stmt->bindParam(':password',  $_POST['password']);
                    $stmt->execute();
                    redirect('auth/login.php');
                } else {
                    $error = 'The email is available.';
                }
            } else {
                $error = 'The number of characters of the password must be at least 6 digits.';
            }
        } else {
            $error = "A password is not the same as repeating it.";
        }
    } else {
        $error = "Please fill in all the values.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background-color: #138496;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">Register</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger"><?php if ($error !== '') echo $error; ?></small>
                </section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action="<?= url('auth/register.php'); ?>" method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name ...">
                    </section>
                    <section class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last_name ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ...">
                    </section>
                    <section class="form-group">
                        <label for="confirm">Confirm</label>
                        <input type="password" class="form-control" name="repassword" id="repassword" placeholder="repassword ...">
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input name="submit" type="submit" class="btn btn-success btn-sm" value="register">
                        <a class="" href="">login</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>