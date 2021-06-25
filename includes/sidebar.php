<!-- sidebar -->
<aside>
    <div class="block-aside login">
        <h3>Buscar: </h3>
        <form action="search.php" method="post">
            <input type="text" name="search" minlength="1">
            <br>
            <input type="submit" value="Enviar" name="submit">
        </form>

        <?php echo isset($_SESSION['login_error']) ?  printErrors($_SESSION['login_error']) : '' ?>
        <?php if(isset($_SESSION['login_error'])) $_SESSION['login_error'] = null; unset($_SESSION['login_error']); ?>
    </div>

    <?php if(!isset($_SESSION['logged']) || isset($_POST['login_error'])): ?>
    <div class="block-aside login">
        <h3>Inicia sesion</h3>
        <form action="login.php" method="post">
            <label for="email">email:</label>
            <br>
            <input type="email" name="email" minlength="1">
            <br>

            <label for="password">Contraseña:</label>
            <br>
            <input type="password" name="password" minlength="1">
            <br>

            <input type="submit" value="Enviar" name="submit">
        </form>

        <?php echo isset($_SESSION['login_error']) ?  printErrors($_SESSION['login_error']) : '' ?>
        <?php if(isset($_SESSION['login_error'])) $_SESSION['login_error'] = null; unset($_SESSION['login_error']); ?>
    </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['logged'])): ?>
    <div class="block-aside user-logged">
        <?= '<h3> Bienvenido '.$_SESSION['logged']['nombre']. '</h3><br>'; ?>
        <a href="append-post.php" class="user-button">Crear entrada</a>
        <a href="append-categorie.php" class="user-button">Crear categoria</a>
        <a href="user-data.php" class="user-button">Mis datos</a>
        <a href="logout.php" class="user-button red-button">Cerrar sesion.</a>
    </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['logged']) || isset($_SESSION['error-login'])): ?>
    <div class="block-aside register">
        <h3>Registrate</h3>
        <form action="register.php" method="post">
            <label for="name">Nombre:</label>
            <br>
            <input type="text" name="name" required="required">
            <br>
            <?php echo isset($_SESSION['errors']['name']) ? printErrors($_SESSION['errors']['name']) : ''; ?>

            <label for="lastname">Apellido:</label>
            <br>
            <input type="text" name="lastname" required="required">
            <br>
            <?php echo isset($_SESSION['errors']['lastname']) ? printErrors($_SESSION['errors']['lastname']) : ''; ?>

            <label for="email">email:</label>
            <br>
            <input type="email" name="email" required="required">
            <br>
            <?php echo isset($_SESSION['errors']['email']) ? printErrors($_SESSION['errors']['email']) : ''; ?>
            
            <label for="password">Contraseña:</label>
            <br>
            <input type="password" name="password" required="required" minlength="7">
            <br>
            <?php echo isset($_SESSION['errors']['password']) ? printErrors($_SESSION['errors']['password']) : ''; ?>

            <input type="submit" value="Enviar" name="submit">
        </form>
        <?php if(isset($_SESSION['errors'])) deleteErrors($_SESSION['errors']); ?>
    </div>    
    <?php elseif(isset($_SESSION['logged']) && $_SESSION['logged']): ?>
        <!-- <div>Registro confirmado ✅</div> -->
    <?php endif; ?>
</aside>