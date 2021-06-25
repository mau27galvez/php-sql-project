<!-- header -->
<?php require_once 'includes/header.php'; ?>
<?php if(!(isset($_SESSION['logged']) && (getUserId($db, $_GET['id']) == $_SESSION['logged']['id']))) header('Location: index.php') ?>
        <!-- main -->
        <main class="main">
            <h3>Datos personales: </h3>
            <?php //var_dump(getPost($db, $_GET['id'])); ?>
            <?php $post  = getPost($db, $_GET['id']); ?>
            <?php //var_dump($post); ?>
            <form action="save-post.php?edit=<?= $_GET['id']; ?>" method="POST">
                <label for="title">Titulo: </label>
                <?= '<input type="text" name="title" value="'. $post['titulo']. '">'; ?>
                <br>
                <label for="content">Contenido: </label>
                <?= '<textarea type="text" name="content">'. $post['descripcion'].'</textarea>'; ?>
                <br>
                <select name="categorie">
                    <?php printCategoriesSelect($db, $post['categoria_id']) ?>
                </select>
                <br>   
                <input type="submit" value="Actualizar">
            </form>

            <?php echo isset($_SESSION['errors']) ? printErrors($_SESSION['errors'], true) : ''; ?>
            <?php if(isset($_SESSION['errors'])) deleteErrors($_SESSION['errors']); ?>  
        </main>
    
        <!-- sidebar -->
        <?php require_once 'includes/sidebar.php'; ?>

    <!-- footer -->
    <?php require_once 'includes/footer.php'; ?>