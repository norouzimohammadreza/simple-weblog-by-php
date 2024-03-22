<?php
require_once('./../functions/helpers.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css'); ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css/'); ?>" media="all" type="text/css">
</head>

<body>
    <section id="app">
        <!-- start header from folder -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-red">
            <a class="navbar-brand" href="">Admin Panel</a>
            <section class="collapse navbar-collapse" id="navbarSupportedContent"></section>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="text-decoration-none text-white" href="">logout</a>
        </nav>
        <!-- end header -->
        <section class="container-fluid">
            <section class="row">
                <section class="col-md-2 p-0">
                    <!-- start sid -->
                    <section class="sidebar">
                        <section class="sidebar-link">
                            <a href="">panel</a>
                        </section>
                        <section class="sidebar-link">
                            <a href="">category</a>
                        </section>
                        <section class="sidebar-link">
                            <a href="">post</a>
                        </section>
                    </section>

                    <!-- end side -->
                </section>
                <section class="col-md-10 pb-3">

                    <section style="min-height: 80vh;" class="d-flex justify-content-center align-items-center">
                        <section>
                            <h1>Management System</h1>
                        </section>
                    </section>

                </section>
            </section>
        </section>


    </section>

    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
</body>

</html>