<?php

 session_start();
 
 require_once '../../classes/category/Category.php';
 require_once '../../classes/plateform/Plateform.php';
 require_once '../../classes/game/GameModel.php';
 require_once '../../lib/functions.php';

 $title = $_SERVER["SCRIPT_NAME"];

 
 
 $game = new GameModel;
 $list = $game->showAllGames();
?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once ("../../partials/header.php") ?>
    <br>
    <h1 style="text-align: center">les jeux</h1>
    <br>
    <?php foreach($list as $key => $values) : ?>
        <div class="card">
            <h2 style="text-align: center"> <u><?= $values["libelle_jeu"] ?></u></h2>
            <div class="list-group" style="">   
                <img src="/img-storage/<?=$values["nom_img"] ?>" alt="photo du jeu" width="300" height="300px">
                <div class="container" style="margin-right: 0px; margin-left: 437px; ">
                    <p><strong>nom:</strong><?= " " . $values["libelle_jeu"]?></p>
                    <p><strong>createur:</strong><?= " " . $values["createur_jeu"]?></p>
                    <p><strong>studio:</strong><?= " " . $values["studio_jeu"]?></p>
                    <p><strong>langues supportées:</strong><?= " " . $values["langue_jeu"]?></p>
                    <p><strong>genre:</strong><?=  " " . $values["genre_jeu"]?></p>
                    <p><strong>plateformes:</strong><?= " " . $values["libelle_plateforme"]?></p>
                    <p><strong>note:</strong><?= " " . $values["note"] . "/20"?></p>
                    <br>
                    <br>
                </div>
            </div>
            <div class="comments" style="float: left; border: 15px solid black; width: 100%; height: auto; border-radius: 1px 100px / 120px; padding: 30px;">
                <p><strong>avis: <br></strong><?= " " . $values["commentaire"]?></p>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    <?php endforeach ?>
    <script src="scripts/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>