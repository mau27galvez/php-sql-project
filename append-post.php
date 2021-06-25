<?php require_once 'includes/header.php'; ?>
<?php
    if(!isset($_SESSION['logged']))
    {
        header('Location: index.php');
    }
?>

<main class="main">
    <h3>Crear post</h3>
    
    <form action="save-post.php" method="post">
        <label for="title">Titulo: </label>
        <input type="text" name="title">
        <br>
        <label for="content">Contenido:</label>
        <textarea name="content"></textarea>
        <br>
        <label for="categorie">categoria:</label>
        <select name="categorie">
            <?php printCategoriesSelect($db) ?>
        </select>
        <br>
        <input type="submit" value="Guardar">
    </form>

    <?php echo isset($_SESSION['errors']) ? printErrors($_SESSION['errors'], true) : ''; ?>
    <?php if(isset($_SESSION['errors'])) deleteErrors($_SESSION['errors']); ?>
</main>

<?php require_once 'includes/sidebar.php'; ?>
<?php require_once 'includes/footer.php'; ?>