<?php require_once 'includes/header.php'; ?>
<?php if(!isset($_SESSION['logged'])) header('Location: index.php'); ?>

<main class="main">
    <h3>Datos personales: </h3>

    <form action="update-user-data.php" method="POST">
        <label for="name">Nombre: </label>
        <spam name="name"><?= $_SESSION['logged']['nombre']; ?></spam>
        <br>
        <label for="lastname">Apellido: </label>
        <spam name="lastname"><?= $_SESSION['logged']['apellido']; ?></spam>
        <br>
        <label for="new_email">email: </label>
        <input type="email" name="new_email" value="<?= $_SESSION['logged']['email']; ?>" required="required">
        <br>
        <label for="new-password">Nueva contraseña: </label>
        <input type="password" name="new_password" minlength="7">
        <br>
        <label for="password">contraseña actual: </label>
        <input type="password" name="password" required="required">
        <br>
        <input type="submit" value="Actualizar">
    </form>
    <?php if(isset($_SESSION['errors'])) printErrors($_SESSION['errors'], true)?>
    <?php if(isset($_SESSION['errors'])) deleteErrors($_SESSION['errors']); ?>
</main>

<?php require_once 'includes/sidebar.php'; ?>
<?php require_once 'includes/footer.php'; ?>