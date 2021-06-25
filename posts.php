<!-- header -->
<?php require_once 'includes/header.php'; ?>

        <!-- main -->
        <main class="main">
            <h3>Entradas</h3>

            <?php printPosts($db, -1); ?>
        </main>
    
        <!-- sidebar -->
        <?php require_once 'includes/sidebar.php'; ?>

    <!-- footer -->
    <?php require_once 'includes/footer.php'; ?>