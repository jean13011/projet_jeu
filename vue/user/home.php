<?php

    session_start();

    include_once ("../../classes/user/User.php");

    //including functions for a more clean code
    include_once ("../../lib/functions.php");
    $user = new User;

    //set the pseudo of the user which is passed in the $_SESSION for using it in the menu 
    setPseudoForUser();

    //sessions conditions
    sessionsSignIn();

    $title = $_SERVER["SCRIPT_NAME"];

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
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Recherche..." method="GET" aria-label="Search"  name="q" autofocus>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
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
        <h2>Bienvenue <?= ucfirst(setPseudoForUser()) ?> </h2>

        <?php display($user) ?>    
        <script src="scripts/app.js"></script>
        <script src="scripts/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
    </body>
</html>