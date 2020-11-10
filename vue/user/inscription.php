<?php
    session_start();

    if(isset($_SESSION["userDeleted"]))
    {
        echo $_SESSION["userDeleted"];
    }
   
    require_once '../../classes/user/User.php';
    require_once '../../lib/functions.php';

    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_DEFAULT);
    $accreditation = filter_input(INPUT_POST, 'Accreditation', FILTER_DEFAULT);
   
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
        $user->insertNewUser($pass, $user);
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <?php require_once ("../../partials/header.php") ?>
        <h1>Inscription</h1>
        <?php 
            displayIdenticalPasswordError();
            displayEmailTakenOrIncomplete();
            incompleteSignIn($pseudo, $email, $password, $confirmPassword);
            
        ?>
        <form method="post" name="formSaisie">
            <label for="pseudo">pseudo</label>
            <input type="text" name="pseudo">
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