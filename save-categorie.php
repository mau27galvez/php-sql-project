<?php 
    if(isset($_POST) && isset($_POST['name']))   
    {
        require_once 'includes/conection.php';

        if(!empty($_POST['name']) && !is_numeric($_POST['name'])) 
        {
            $categorie_name = trim(mysqli_real_escape_string($db, $_POST['name']));
            $query = "INSERT INTO categorias (nombre_categoria) VALUE('$categorie_name')";
            mysqli_query($db, $query);
            var_dump(mysqli_error($db));
        }
        else $errors['name'] = 'El nombre no es valido.';
    }
    
    // header('Location: index.php');