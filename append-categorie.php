<?php require_once 'includes/header.php'; ?>
<?php
    if(!isset($_SESSION['logged']))
    {
        header('Location: index.php');
    }
?>

<main class="main">
    <h3>Crear categoria</h3>
    
    <form action="save-categorie.php" method="post">
        <label for="name">Nombre: </label>
        <input type="text" name="name">
        <br>
        <input type="submit" value="Guardar">
    </form>
</main>

<?php require_once 'includes/sidebar.php'; ?>
<?php require_once 'includes/footer.php'; ?>