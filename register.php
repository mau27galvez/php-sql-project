<?php 
    require_once 'includes/conection.php';
    // session_start();


    if(isset($_POST) && isset($_POST['submit']))
    {
        $name = isset($_POST['name']) ? trim(mysqli_real_escape_string($db, $_POST['name'])) : false;
        $lastname = isset($_POST['lastname']) ? trim(mysqli_real_escape_string($db, $_POST['lastname'])) : false;
        $email = isset($_POST['email']) ? trim(mysqli_real_escape_string($db, $_POST['email'])) : false;
        $password = isset($_POST['password']) ? trim(mysqli_real_escape_string($db, $_POST['password'])) : false;

        $errors = [];

        //NAME
        if(!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name) && $name) $name_validated = true;
        else 
        {
            $name_validated = false;
            $errors['name'] = 'El nombre no es valido.';
        }

        // LASTNAME
        if(!empty($lastname) && !is_numeric($lastname) && !preg_match("/[0-9]/", $lastname) && $lastname) $lastname_validated = true;
        else
        {
            $lastname_validated = false;
            $errors['lastname'] = 'El apellido no es valido.';
        }

        // EMAIL
        if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $email) $email_validated = true;
        else
        {
            $email_validated = false;
            $errors['email'] = 'El email no es valido.';
        }

        // PASSWORD
        if(!empty($password) && strlen($password) >= 7 && $password) $password_validated = true;
        else
        {
            $password_validated = false;
            $errors['password'] = 'La contraseña debe contener al menos 7 elemntos.';
        }


        if(count($errors) == 0 && $name_validated && $lastname_validated && $email_validated && $password_validated)
        {
            // encrypt password
            // to do not do this is ilegal
            $encrypted_password = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
            // the costs is how many times the password will be encrypted

            // var_dump($password);
            // var_dump($encrypted_password);
            // to verify the password
            // var_dump(password_verify($password, $encrypted_password));
            // to get the algorithms able 
            // var_dump(password_algos());
            // to get information about a hash generated by password_hash()
            // var_dump(password_get_info($encrypted_password));

            $insert = "INSERT INTO usuarios(nombre, apellido, email, password) VALUES('$name', '$lastname', '$email', '$encrypted_password');";
            $query = mysqli_query($db, $insert);
            // var_dump(mysqli_error($db));
            // die();
            
            if($query)
            {
                // $user = mysqli_query($db, "SELECT nombre, apellido, email, password FROM usuarios WHERE email = '$email';");
                // $user = mysqli_fetch_assoc($user);
                // $user['password'] = null;
                // unset($user['password']);

                // $_SESSION['logged'] = $user;
                require_once 'login.php';
            }
            else
            {
                $_SESSION['is_logged'] = false;
            }
        }
        else
        {
            $_SESSION['errors'] = $errors;
        }

        header('Location: index.php');
    }