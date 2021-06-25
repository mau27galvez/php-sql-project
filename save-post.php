<?php 
    if(isset($_POST))   
    {
        require_once 'includes/conection.php';
        require_once 'includes/functions.php';

        if(isset($_SESSION['errors']))
        {
            $_SESSION['errors'] = null;
            unset($_SESSION['errors']);
        }

        $errors = [];

        if(!empty($_POST['title'])) 
        {
            $title = trim(mysqli_real_escape_string($db, $_POST['title']));
        }
        else $errors['title'] = 'El titulo no es valido.';

        if(!empty($_POST['content'])) 
        {
            $content = trim(mysqli_real_escape_string($db, $_POST['content']));
        }
        else $errors['content'] = 'El contenido no es valido.';

        if(!empty($_POST['categorie'])) 
        {
            $categorie = (int)trim(mysqli_real_escape_string($db, $_POST['categorie']));
        }
        else $errors['categorie'] = 'La categoria no es valida.';

        if(count($errors) == 0)
        {
            if(isset($_GET['edit']))
            {
                $post_id = $_GET['edit'];
                $user_id = $_SESSION['logged']['id'];
                $query = "UPDATE posts SET titulo='$title', descripcion='$content', categoria_id=$categorie ".
                "WHERE id=$post_id AND usuario_id=$user_id";
            }
            else
            {
                $query = 'INSERT INTO posts (titulo, descripcion, fecha_publicacion, categoria_id, usuario_id)'.
                "VALUE('$title', '$content', CURDATE(), $categorie, '".$_SESSION['logged']['id'] ."');";
            }
            // var_dump($query);
            // die();
            mysqli_query($db, $query);
            header('Location: index.php');
        }
        else 
        {
            $_SESSION['errors'] = $errors;

            if(isset($_GET['edit'])) header('Location: edit-post.php?id='. $_GET['edit']);
            else header('Location: append-post.php');
        }
    }
    else header('Location: index.php');