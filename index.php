<!-- header -->
<?php require_once 'includes/header.php'; ?>

        <!-- main -->
        <main class="main">
            <h3>Ultimas entradas</h3>

            <?php printPosts($db, 4); ?>

            <a href="posts.php" class="see-more">VER MAS</a>
        </main>
    
        <!-- sidebar -->
        <?php require_once 'includes/sidebar.php'; ?>

    <!-- footer -->
    <?php require_once 'includes/footer.php'; ?>