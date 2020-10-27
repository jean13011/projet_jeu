<?php


    include_once ("../../classes/user/User.php");


    if( isset($_SESSION["short"]) ){
        echo $_SESSION["short"];
        session_unset();
    }

    if( isset($_SESSION["created"]) ){
        echo $_SESSION["created"];
        session_unset();
    }

    if( isset($_SESSION["envahisseur"]) ){
        echo $_SESSION["envahisseur"];
        session_unset();
    }

    if( isset($_SESSION["WrongId"]) ){
        echo $_SESSION["WrongId"];
        session_unset();
    }

    if( isset($_SESSION["notConnected"]) ){
        echo $_SESSION["notConnected"];
        session_unset();
    }

    $title = $_SERVER["SCRIPT_NAME"];
    
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="generator" content="Jekyll v4.1.1">
        <link rel="stylesheet" href="../styles/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet">
        <title><?= substr($title, 1,-4) ?></title>
    </head>
    <body>
        
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
                    <input type="password" name="password"placeholder="Mot de passe"  > 
                </div>
                <div>
                    <button type="submit">soumettre</button>
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
