<?php


    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");

    $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    sessionSignUp();

    $title = $_SERVER["SCRIPT_NAME"];

    $error = [];
   
    if($email)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if($password)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if(!in_array(false, $error))
    {
        
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($password);
            $resultat = $user->checkMailForSignIn();
            $user->comparePasswordInDB($resultat); 
    }

    
?>
<!DOCTYPE html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../styles/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title><?= strtoupper(substr($title, 10,-4)) ?></title>
    </head>
        
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand">logo</a>
        </nav>
        <nav class="menu">
            <div>
                <ul>
                    <li><a href="">Jeux vidéo</a></li>
                    <li><a href="">Accéssoires</a></li>
                    <li><a href="">Coup de (coeur)</a></li>
                </ul>
            </div>
        </nav>
        
        <div id="form">
            <form  method="post" class="box">
                <div class="text-center mb-4">
                    <h1>connexion</h1>
                </div>
                <div> 
                    <label for="mail" ></label>
                    <input type="text" name="mail" class="form-control" placeholder="Adresse mail" >
                </div>
                <div>
                    <label for="password" ></label>
                    <input type="password" name="password" placeholder="Mot de passe"  > 
                </div>
                <div>
                    <button type="submit" name="sub" value="submit">soumettre</button>
                    <a href="./inscription.php" id="create">créer un compte</a>
                </div>
            </form>
        </div>
        <?php
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="scripts/script.js"></script>
    </body>
</html>
