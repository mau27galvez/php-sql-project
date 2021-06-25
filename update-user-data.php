<?php
    require_once 'includes/conection.php';

    if(!isset($_SESSION['logged'])) header('Location: index.php');

    if(isset($_POST['password']) && (isset($_POST['new_email']) || isset($_POST['new_password'])))
    {
        $password = $_POST['password'];
        $user_id = $_SESSION['logged']['id'];
        
        $query_get_password = "SELECT password FROM usuarios WHERE id=$user_id";
        $hash = mysqli_query($db, $query_get_password);
        $hash = mysqli_fetch_assoc($hash)['password'];
        
        if(password_verify($password, $hash))
        {
            if(isset($_POST['new_email']) && !empty($_POST['new_email']) && filter_var($_POST['new_email'], FILTER_VALIDATE_EMAIL))
            {
                $new_email = trim(mysqli_real_escape_string($db, $_POST['new_email']));
                $query_email = "UPDATE usuarios SET email='$new_email' WHERE id=$user_id";
                if(mysqli_query($db, $query_email))
                {
                    mysqli_query($db, $query_email);
                    $_SESSION['logged']['email'] = $new_email;
                }else goto save_error;
            }
            else 
            {
                save_error: $errors['email'] = 'email invalido';
            }
            
            if(isset($_POST['new_password']) && !empty($_POST['new_password']))
            {

                if(strlen($_POST['new_password']) >= 7 && $_POST['new_password'])
                {
                    $new_password = trim(mysqli_real_escape_string($db, $_POST['new_password']));
                    $new_password = password_hash($new_password, PASSWORD_BCRYPT, ['cost'=>4]);
                    $query_password = "UPDATE usuarios SET password='$new_password' WHERE id=$user_id";
                    if(mysqli_query($db, $query_password))
                    {
                        mysqli_query($db, $query_password);
                    }else goto save_password;
                }
                else
                {
                    save_password: $errors['new_password'] = 'Nueva contraseña invalida';
                }
            }
        }

        if(!isset($errors) || count($errors) == 0) header('Location: index.php');
        else 
        {
            $_SESSION['errors'] = $errors;
            header('Location: user-data.php');
        }
    }
    else 
    {
        $errors['password'] = 'Contraseña incorrecta';
    
        if(!isset($errors) || count($errors) == 0) header('Location: index.php');
        else 
        {
            $_SESSION['errors'] = $errors;
            var_dump('hola?');
            header('Location: user-data.php');
        }
    }