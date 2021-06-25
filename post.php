<?php if(!isset($_GET)) header('Location: index.php'); ?>

<!-- header -->
<?php require_once 'includes/header.php'; ?>
<?php if(!isPostDefined($db, $_GET['id'])) header('Location: index.php'); ?>

        <!-- main -->
        <main class="main">
            <?php printPost($db, $_GET['id']); ?>

            <?php if(isset($_SESSION['logged']) && (getUserId($db, $_GET['id']) == $_SESSION['logged']['id'])): ?>
                <?php echo '<a href="edit-post.php?id='. $_GET['id'].'" class="button">Editar post</a>' ?>
                <?php echo '<a href="delete-post.php?id='. $_GET['id'].'" class="button red-button">Eliminar post</a>' ?>
            <?php endif; ?> 
        </main>

        <!-- sidebar -->
        <?php require_once 'includes/sidebar.php'; ?>

    <!-- footer -->
    <?php require_once 'includes/footer.php'; ?>