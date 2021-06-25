<?php 
    session_start();

    if(isset($_SESSION['logged']))
    {
        $_SESSION['logged'] = null;
        unset($_SESSION['logged']);
    }

    header('Location: index.php');