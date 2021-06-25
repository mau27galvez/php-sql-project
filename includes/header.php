<?PHP 
    require_once 'conection.php'; 
    require_once 'functions.php';
?>


<!DOCTYPE html>
<html lang="es" dir="lrt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./assets/css/main.css">
    <title>Blog</title>
</head>
<body>
    <!-- header -->
    <header>
        <div class="titulo">
            <h1>Un Blog mas</h1>
        </div>
        
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <?php printCategories($db); ?>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">