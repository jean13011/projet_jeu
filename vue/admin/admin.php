<?php
    session_start();
    include_once ("../../classes/admin/Admin.php");
    include_once ("../../lib/functions.php");
?>

<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <title>votre espace admin</title>
    </head>
        
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand">logo</a>
        </nav>

        <div id="form">
            <form  method="post" class="box">
                <div class="text-center mb-4">
                    <h1>connexion à l'espace administrateur</h1>
                </div>
                <div> 
                    <label for="mail" ></label>
                    <input type="text" name="mail" class="form-control" placeholder="Adresse mail" >
                </div>
                <div>
                    <label for="password" ></label>
                    <input type="password" name="password" placeholder="Mot de passe"  class="form-control"> 
                </div>
                <br>
                <div>
                    <button type="submit" name="sub" value="submit">soumettre</button>
                </div>
            </form>
        </div>
        <script src="scripts/script.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>