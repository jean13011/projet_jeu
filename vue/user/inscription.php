<?php
    session_start();


   
    require_once '../../classes/user/User.php';
    require_once '../../lib/functions.php';

    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_DEFAULT);
    $key = getKey($pseudo);
   
    $title = $_SERVER["SCRIPT_NAME"];

    // $input = new InputError();
    // $error = $input->valid($_POST);
   
    $error = [];
   

    if($pseudo)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

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

        $user = new User($pseudo, $email, $password);
        $req = $user->comparePassword($password, $confirmPassword);
        $user->checkMailForSignUp();
        $pass = $user->hashPassword();
        $user->insertNewUser($pass, $user, $key);

    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
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
        <h1>Inscription</h1>
        <?php 
            displayIdenticalPasswordError();
            displayEmailTakenOrIncomplete();
            echo $key;

        ?>
        <form method="post" name="formSaisie">
            <label for="pseudo">pseudo</label>
            <input type="text" name="pseudo" >
            <label for="mail">e-mail</label>
            <input type="email" name="mail" >
            <label for="password">mot de passe</label>
            <input type="password" name="password">
            <label for="password">confirmer mot de passe</label>
            <input type="password" name="confirmPassword" >
            <button type="submit">soumettre</button>
            <a href="connexion.php">Se connecter</a>
        </form>
        <script src="./fonctions.js"></script>
    </body>
</html>