<?php 
    require_once 'includes/conection.php';

    if(isset($_POST) && isset($_POST['email']) && $_POST['password'])
    {
        $email = trim(mysqli_real_escape_string($db, $_POST['email']));
        $password = $_POST['password'];

        // $user = mysqli_query($db, "SELECT nombre, apellido, email, password FROM usuarios WHERE email = '$email';");
        $user = mysqli_query($db, "SELECT * FROM usuarios WHERE email = '$email';");

        if(isset($user) && $user && mysqli_num_rows($user) == 1)
        {
            $user = mysqli_fetch_assoc($user);
            $user_password = $user['password'];

            $password_verified = password_verify($password, $user_password);

            if($password_verified)
            {   
                if(isset($_SESSION['login_error']))
                {
                    $_SESSION['login_error'] = null;
                    unset($_SESSION['login_error']);
                }

                unset($user['password']);
                $_SESSION['logged'] = $user;
            }
            elseif(!$password_verified)
            {
                $_SESSION['login_error'] = 'Contraseña incorrecta.';
            }
        }
        else
        {
            $_SESSION['login_error'] = 'Usuario desconocido.';
        }
    }
    else
    {
        // $_SESSION['login_error'] = 'Error en el login.';
        if(isset($_SESSION['login_error']))
        {
            $_SESSION['login_error'] = null;
            unset($_SESSION['login_error']);
        }
    }

    header('Location: index.php');