<?php

    session_start();

    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");
    
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


    setPseudoForUser();
    $title = $_SERVER["SCRIPT_NAME"];

    $error = [];

    $oldPseudo =  filter_input(INPUT_POST, 'currentPseudo', FILTER_DEFAULT);
    $pseudo = filter_input(INPUT_POST, 'newPseudo', FILTER_DEFAULT);
   
    if($pseudo)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if(!in_array(false, $error))
    {
        
        $user = new User();
        $user->setPseudo($pseudo);
        $user->changePseudo();    
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../styles/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>PROFIL</title>
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
    <a href="profilUser.php">retour</a>
    <form  method="post">
        <label for="currentPseudo">pseudo actuel</label>
        <input type="text" name="currentPseudo" value="<?= setPseudoForUser() ?>" >
        <label for="newPseudo">nouveau pseudo</label>
        <input type="text" name="newPseudo" >
        <button type="submit">soumettre</button>
    </form>
</body>
</html>