<?php
    // function printErrors($errors, $index=false)
    // {
    //     if($index)
    //     {
    //         if(isset($errors) && isset($errors[$index]))
    //         {
    //             return '<div class="alert-error">'. $errors[$index]. '</div>';
    //         }
    //     }
    //     elseif(!$index)
    //     {
    //         if(isset($errors))
    //         {
    //             return '<div class="alert-error">'. $errors. '</div>';
    //         }
    //     }

    //     return '';
    // }

    function printErrors($errors, $index=false)
    {
        if($index)
        {
            if(isset($errors))
            {
                foreach($errors as $error)
                {
                    echo '<div class="alert-error">'. $error. '</div>';
                }
            }
        }
        elseif(!$index)
        {
            if(isset($errors))
            {
                return '<div class="alert-error">'. $errors. '</div>';
            }
        }

        return '';
    }

    function deleteErrors()
    {
        if(isset($_SESSION['errors']))
        {
            $_SESSION['errors'] = null;
            unset($_SESSION['errors']);

            // return true if the var does not exists any more and false if it still doing
            return isset($_SESSION['errors']) ? false : true;
        }

        // return true because the variable never exists
        return true;
    }

    function printCategories($db)
    {
        $query = 'SELECT * FROM categorias'
        ;
        $categories = mysqli_query($db, $query); 
        
        if(isset($categories) && $categories && mysqli_num_rows($categories) >= 1)
        {
            while($categorie = mysqli_fetch_assoc($categories))
            {
                echo '<li><a href="categories.php?id='. $categorie['id']. '">'. $categorie['nombre_categoria']. '</a></li>'; 
            }
        }
    }

    function printCategoriesSelect($db, $default=false)
    {
        $query = 'SELECT * FROM categorias'
        ;
        $categories = mysqli_query($db, $query); 
        
        if(isset($categories) && $categories && mysqli_num_rows($categories) >= 1)
        {
            if($default)
            {
                while($categorie = mysqli_fetch_assoc($categories))
                {
                    if($default == $categorie['id']) echo '<option value='. $categorie['id'].' selected>'. $categorie['nombre_categoria']. '</option>'; 
                    else echo '<option value='. $categorie['id'].'>'. $categorie['nombre_categoria']. '</option>'; 
                }
            }
            else
            {
                while($categorie = mysqli_fetch_assoc($categories))
                {
                    echo '<option value='. $categorie['id'].'>'. $categorie['nombre_categoria']. '</option>'; 
                }
            }
        }
    }

    function printPosts($db, $quantity = -1)
    {
        if($quantity == -1)
        {
            $query = 'SELECT posts.*, categorias.nombre_categoria '. 
            'FROM posts '. 
            'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
            'ORDER BY posts.fecha_publicacion DESC;';
        }
        elseif($quantity >= 0)
        {
            $query = 'SELECT posts.*, categorias.nombre_categoria '. 
            'FROM posts '. 
            'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
            'ORDER BY posts.fecha_publicacion DESC '.
            "LIMIT $quantity;";
        }
        else return false;
        
        $posts = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($posts) && $posts && mysqli_num_rows($posts) >= 1)
        {
            while($post = mysqli_fetch_assoc($posts))
            {
                echo '<article class="posts">'.
                '<a href="post.php?id='. $post['id']. '">'.
                '<h2 class="posts-title">'. $post['titulo']. '</h2>'.
                '<span class="categorie-date">'. $post['nombre_categoria']. ' | '. $post['fecha_publicacion'].'</span>'.
                '<p class="description">'. substr($post['descripcion'], 0, 300). '</p>'.
                '</a>'.
                '</article>';
            }
        }
        else return false;
    }

    function printPostsOf($db, $categorie_id, $search_parameters=null)
    {
        if(!empty($categorie_id))
        {
            $query = 'SELECT posts.*, categorias.nombre_categoria '. 
            'FROM posts '. 
            'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
            "WHERE posts.categoria_id=$categorie_id ".
            'ORDER BY posts.fecha_publicacion DESC;';
        }
        
        if(!empty($search_parameters))
        {
            $query = 'SELECT posts.*, categorias.nombre_categoria '. 
            'FROM posts '. 
            'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
            "WHERE posts.titulo LIKE '%$search_parameters%' ".
            'ORDER BY posts.fecha_publicacion DESC;';
        }
        
        $posts = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        // die();
        if(isset($posts) && $posts && mysqli_num_rows($posts) >= 1)
        {
            while($post = mysqli_fetch_assoc($posts))
            {
                echo '<article class="posts">'.
                '<a href="post.php?id='. $post['id']. '">'.
                '<h2 class="posts-title">'. $post['titulo']. '</h2>'.
                '<span class="categorie-date">'. $post['nombre_categoria']. ' | '. $post['fecha_publicacion'].'</span>'.
                '<p class="description">'. substr($post['descripcion'], 0, 300). '</p>'.
                '</a>'.
                '</article>';
            }
        }
        else echo '<div class="alert-error">Aun no hay entradas en esta  categoria.</div>';
    }

    function printPost($db, $post_id)
    {
        $query = 'SELECT posts.*, categorias.nombre_categoria '. 
        'FROM posts '. 
        'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
        "WHERE posts.id=$post_id;";

        
        $posts = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($posts) && $posts && mysqli_num_rows($posts) == 1)
        {
            while($post = mysqli_fetch_assoc($posts))
            {
                echo '<article class="posts">'.
                '<h2 class="posts-title">'. $post['titulo']. '</h2>'.
                '<span class="categorie-date">'. $post['nombre_categoria']. ' | '. $post['fecha_publicacion'].'</span>'.
                '<p class="description">'. $post['descripcion']. '</p>'.
                '</a>'.
                '</article>';
            }
        }
        else return false;
    }

    function getPost($db, $post_id)
    {
        $query = 'SELECT posts.*, categorias.nombre_categoria '. 
        'FROM posts '. 
        'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
        "WHERE posts.id=$post_id;";

        
        $posts = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($posts) && $posts && mysqli_num_rows($posts) >= 1) 
        {
            $posts_result = [];
            while($current_post = mysqli_fetch_assoc($posts))
            {
                array_push($posts_result, $current_post);
            }
            
            return $posts_result[0];
        }
        else return false;
    }

    function isPostDefined($db, $post_id)
    {
        $query = 'SELECT posts.*, categorias.nombre_categoria '. 
        'FROM posts '. 
        'INNER JOIN categorias ON posts.categoria_id = categorias.id '.
        "WHERE posts.id=$post_id;";

        
        $posts = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($posts) && $posts && mysqli_num_rows($posts) == 1) return true;
        else return false;
    }

    function deletePost($db, $post_id)
    {
        $query = 'DELETE FROM posts '.
        'WHERE id='. $post_id.';';

        mysqli_query($db, $query);  
        // var_dump(mysqli_error($db));
    }

    function getCategorieName($db, $categorie_id)
    {
        $query = 'SELECT nombre_categoria '. 
        'FROM categorias '. 
        "WHERE id=$categorie_id;";
        
        $categorie_name = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($categorie_name) && $categorie_name && mysqli_num_rows($categorie_name) == 1)
        {
            $categorie_name = mysqli_fetch_assoc($categorie_name)['nombre_categoria'];
            
            return $categorie_name;
        }
        else return false;
    }

    function getCategorieId($db, $categorie_name)
    {
        $query = 'SELECT id '. 
        'FROM categorias '. 
        "WHERE nombre_categoria='$categorie_name';";
        
        $categorie_id = mysqli_query($db, $query); 
        // var_dump(mysqli_error($db));
        if(isset($categorie_id) && $categorie_id && mysqli_num_rows($categorie_id) == 1)
        {
            $categorie_id = mysqli_fetch_assoc($categorie_id)['id'];
            
            return (int)$categorie_id;
        }
        else return false;
    }

    function getUserId($db, $post_id)
    {
        $query = 'SELECT usuario_id '.
                 'FROM posts '.
                 "WHERE id = $post_id;";

        $user_id = mysqli_query($db, $query);
        // var_dump(mysqli_error($db));
        if(isset($user_id) && $user_id && mysqli_num_rows($user_id) == 1)
        {
            $user_id = mysqli_fetch_assoc($user_id)['usuario_id'];
            
            return $user_id;
        }
        else return false;
    }