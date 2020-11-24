<?php


    include_once ("../../classes/user/User.php");
    include_once ("../../lib/functions.php");

    $email = filter_input(INPUT_POST, 'mail', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $remember = filter_input(INPUT_POST, 'rememberMe', FILTER_DEFAULT);

    sessionSignUp();

    

    $title = $_SERVER["SCRIPT_NAME"];

    $error = [];
   
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
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);
        $resultat = $user->checkMailForSignIn();
        $user->comparePasswordInDB($resultat);  
    }

    if(isset($_POST["rememberMe"]))
    {
        $user = new User;
        $resultat = $user->checkMailForSignIn();

       var_dump( remember($resultat));
       die();
    }

    
?>
<!DOCTYPE html>

    <?php require_once ("../../partials/header.php") ?>
        
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
                    <input type="password" name="password" placeholder="Mot de passe"  class="form-control"> 
                </div>
                <div>
                    <input type="checkbox" name="rememberMe" id="remembercheckbox" /><label for="remembercheckbox">Se souvenir de moi</label>
                    <br/><br/>
                </div>
                <br>
                <div id="send">
                    <button type="submit" name="sub" value="submit">soumettre</button>
                </div>
                <a href="inscription.php" id="create">créer un compte</a>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>
</html>
