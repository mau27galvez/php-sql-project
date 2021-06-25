<?php if(!isset($_GET)) header('Location: index.php'); ?>

<!-- header -->
<?php require_once 'includes/header.php'; ?>
<?php //var_dump(printPostsOf($db, $_GET['id'])); ?>
<?php if(!getCategorieName($db, $_GET['id'])) header('Location: index.php'); ?>

        <!-- main -->
        <main class="main">
            <?= '<h3>Entradas de '. getCategorieName($db, $_GET['id']). '</h3>'; ?>

            <?php //var_dump(getCategorieId($db, $_GET['id'])); ?>
            <?php printPostsOf($db, $_GET['id']); ?>
            <?php //var_dump(printPostsOf($db, getCategorieId($db, $_GET['id']))); ?>

            <a href="posts.php" class="see-more">VER MAS</a>
        </main>
    
        <!-- sidebar -->
        <?php require_once 'includes/sidebar.php'; ?>

    <!-- footer -->
    <?php require_once 'includes/footer.php'; ?>