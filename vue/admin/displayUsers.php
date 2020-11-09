<?php
    session_start();

    if(isset($_SESSION["userDeleted"]))
    {
        echo $_SESSION["userDeleted"];
    }

    if(!isset($_SESSION["user"]))
    {
        session_start();
        header("location:../user/connexion.php");
        echo "page introuvable connectez-vous !!";
        
    }
   
    require_once '../../classes/user/User.php';
    require_once '../../lib/functions.php';

    $pseudo = filter_input(INPUT_POST, 'spseudo', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'smail', FILTER_VALIDATE_EMAIL);
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

    if(!in_array(false, $error))
    {

        $user = new User;
        $user->displayUsers($pseudo, $email);
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php require_once ("../../partials/header.php") ?>
        
        <h2>recherchez un utilisateur</h2>
        <form  method="post">
            <label for="pseudo">pseudo</label>
            <input type="text" name="spseudo">
            <label for="mail">email</label>
            <input type="text" name="smail">
            <button type="submit" name="sub" value="2">envoyer</button>
        </form>
        <div class="form">
            <!-- ajoute un bouton supprimer et ajouter pour tout les joueurs trouvé -->
            <?php  updateAndDeleteForAll($user) ?>

        </div>
    
    <script src="../../script/app.js"></script>   
    </body>
</html>
