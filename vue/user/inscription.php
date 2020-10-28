<?php
    session_start();


    if( isset($_SESSION["alreadyExist"]) ){
            echo $_SESSION["alreadyExist"];
            session_unset();
    }
    
    if( isset($_SESSION["incomplete"]) ){
        echo $_SESSION["incomplete"];
        session_unset();
    }
    
    require_once '../../classes/user/User.php';

    $name = filter_input(INPUT_POST, 'name', FILTER_DEFAULT);
    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_DEFAULT);
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

   
    $title = $_SERVER["SCRIPT_NAME"];

    // $input = new InputError();
    // $error = $input->valid($_POST);
   
    $error = [];
   
    if($name)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($firstName)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

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

        $error []= false;
    }

    if($password)
    {
        $error[] = true;
        
    }else{

        $error []= false;
    }

    if(!in_array(false, $error))
    {

            $user = new User($name, $firstName, $pseudo, $email, $password);
            var_dump($user);
            $user->checkMail();
            $pass = $user->hashPassword();
            $user->insertInBdd($pass, $user);
            
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        
        <title><?= substr($title, 10,-4) ?></title>
    </head>
    <body>
        <h1>Inscription</h1>
        <form method="post" name="formSaisie">
            <label for="name">Nom</label>
            <input type="text" name="firstName" >
            <label for="firstName">prénom</label>
            <input type="text" name="name" >
            <label for="pseudo">pseudo</label>
            <input type="text" name="pseudo" >
            <label for="mail">e-mail</label>
            <input type="email" name="mail" >
            <label for="password">mdp</label>
            <input type="password" name="password" >
            <button type="submit">soumettre</button>
            <a href="connexion.php">Se connecter</a>
        </form>
        <script src="./fonctions.js"></script>
    </body>
</html>