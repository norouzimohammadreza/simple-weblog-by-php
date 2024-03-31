<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: darkgoldenrod;">

    <a class="navbar-brand " href="<?= url('panel'); ?> ">weblog</a>
    <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent ">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active ">
                <a class="nav-link " href="<?= url(''); ?>">Home <span class="sr-only ">(current)</span></a>
            </li>
        <?php
        $sql = 'SELECT * FROM categories';
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        foreach ($categories as $category) { ?>
            <li class="nav-item ">
                <a class="nav-link " href="<?= url('category.php?cat_id='. $category->id) ?>"><?= $category->title ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>

    <section class="d-inline ">
        <?php
        $sql = 'SELECT * FROM users WHERE email=:email';
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':email', $_SESSION['user']);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user !== false) { ?>
            <a class="text-decoration-none text-white px-2 " href="<?= url('auth/logout.php'); ?>">logout</a>
        <?php    } else { ?>

            <a class="text-decoration-none text-white px-2 " href=" <?= url('auth/register.php'); ?>">register</a>
            <a class="text-decoration-none text-white " href=" <?= url('auth/login.php'); ?>">login</a>
        <?php    } ?>


    </section>
</nav>