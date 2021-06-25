<?php 
    require_once 'includes/conection.php';
    require_once 'includes/functions.php';
    // var_dump(isset($_SESSION['logged']) && (getUserId($db, $_GET['id']) == $_SESSION['logged']['id']));
    // die();
    if(isset($_SESSION['logged']) && (getUserId($db, $_GET['id']) == $_SESSION['logged']['id']))
    {
        deletePost($db, $_GET['id']);
        header('Location: index.php');
    }
    else
    {
        // var_dump(isset($_SESSION['logged']) && (getUserId($db, $_GET['id']) == $_SESSION['logged']['id']));
        // die();
        header('Location: index.php');
    }