<?php
    session_start();

    require_once '../../classes/user/User.php';
    require_once '../../lib/functions.php';

    $pseudo = filter_input(INPUT_POST, 'spseudo', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'smail', FILTER_VALIDATE_EMAIL);
    $role = filter_input(INPUT_POST, 'srole', FILTER_DEFAULT);
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

    if($role)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if(!in_array(false, $error))
    {

        $user = new User;
        $req = $user->delete($id);
    }

?>

<!DOCTYPE html>
<html lang="fr">
    <?php 
        require_once ("../../partials/header.php");
        treatments();
    ?>
        
        <h2>recherchez un utilisateur</h2>
        <form  method="post">
            <label for="pseudo">pseudo</label>
            <input type="text" name="spseudo">
            <label for="mail">email</label>
            <input type="text" name="smail" >
            <label for="role">role</label>
            <input type="text" name="srole" >
            <button type="submit" name="sub" value="2">envoyer</button>
        </form>
        <div class="display" style="display: flex; justify-content: space-evenly; margin-top: 53px">
        
            <!-- ajoute un bouton supprimer et ajouter pour tout les users trouvé -->
            <?php updateAndDeleteForAll($user)?>

        </div>
    
    <script src="../../script/app.js"></script>   
    </body>
</html>
