<?php
    session_start();

    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");

    setPseudoForUser();

    if(isset($_SESSION["pseudoChanged"]))
    {

        echo $_SESSION["pseudoChanged"];
    }
    $title = $_SERVER["SCRIPT_NAME"];

   
    $user= new User;
    checkForDeleteUser($user);

?>

<!DOCTYPE html>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../styles/style.css">
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
        <div class="profilUser">
            <h1>modifiez votre profil</h1>
            <form>
                <button type="submit" name="updatePass" value="updated" id="changePass"><a href="changePass.php">modifiez votre mot de passe</a></button>
            </form>
            <br>
            <form>
                <button type="submit" name="updatePseudo" value="updated" id="changePseudo"><a href="changePseudo.php">modifiez votre pseudo</a></button>
            </form>
            <br>
            <form method="post">
                <button type="submit" name="deleteUser" value="deleted" id="deleteUser" style="color: red">supprimez votre compte</button>
            </form>
        </div>
        
        <script src="../../script/app.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
            
</body>
</html>