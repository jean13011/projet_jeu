<?php
    session_start();

    if(!$_SESSION["connected"])
    {

        $_SESSION['notConnected'] = 'Veuillez vous connecter';
        header("location:./connexion.php");
        die();
    } 

    if(isset($_SESSION["wrongPass"]))
    {
        echo $_SESSION["wrongPass"];
    } 

    if(isset($_SESSION["samePass"]))
    {
        echo $_SESSION["samePass"];
    } 

    if( isset($_SESSION["passChanged"]))
    {

        echo $_SESSION["passChanged"];
    }

    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");

    setPseudoForUser();
    $title = $_SERVER["SCRIPT_NAME"];

   
    $oldPassword =  filter_input(INPUT_POST, 'currentPassword', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'newPassword', FILTER_DEFAULT);
    
    $error = [];
   
    if($password)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if(!in_array(false, $error))
    {
        
            $user = new User();
            $user->setPassword($password);
            $resultat = $user->checkId();
            $passHash = $user->hashPassword();
            $req = $user->changePassword($resultat, $passHash);
            var_dump($req);
            $user->addedPassword($req);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title><?= strtoupper(substr($title, 10,-8)) ?></title>
</head>
        
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand">logo</a>
        
        <ul id="bloc">
            <li><a href="profilUser.php"><?= ucfirst(setPseudoForUser()) ?></a></li>
            <form action="logout.php" >
                <button type="submit">Se déconnecter</button>
            </form>
        </ul>
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
    <a href="home.php">retour</a>
    <form  method="post">
        <label for="currentPassword">mot de passe actuel</label>
        <input type="password" name="currentPassword" >
        <label for="newPassword">nouveau mot de passe</label>
        <input type="password" name="newPassword" >
        <button type="submit" >soumettre</button>
    </form>
</body>
</html>