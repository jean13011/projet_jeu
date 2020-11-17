<?php

    session_start();

    include_once ("../../classes/user/User.php");
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
    <?php require_once ("../../partials/navbar.php") ?>
    

        <h2>Bienvenue <?= ucfirst(setPseudoForUser()) ?> </h2>

        <?php showUser($user) ?>    
        <script src="scripts/app.js"></script>
        <script src="scripts/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    
    </body>
</html>




