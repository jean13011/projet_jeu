<?php
    session_start();

    require_once '../../classes/category/Category.php';
    require_once '../../classes/plateform/Plateform.php';
    require_once '../../classes/game/Game.php';
    require_once '../../lib/functions.php';

    $name = filter_input(INPUT_POST, 'acronyme', FILTER_DEFAULT);
    $libelleGame = filter_input(INPUT_POST, 'nom', FILTER_DEFAULT);
    $creator = filter_input(INPUT_POST, 'createur', FILTER_DEFAULT);
    $studio = filter_input(INPUT_POST, 'studio', FILTER_DEFAULT);
    $traduction = filter_input(INPUT_POST, 'langue', FILTER_DEFAULT);
    $category = filter_input(INPUT_POST, 'genre', FILTER_DEFAULT);
    $plateform = filter_input(INPUT_POST, 'plateforme', FILTER_DEFAULT);
    $commentary = filter_input(INPUT_POST, 'commentaire', FILTER_DEFAULT);
    $note = filter_input(INPUT_POST, 'note', FILTER_DEFAULT);
    
    $title = $_SERVER["SCRIPT_NAME"];
   
    $error = [];
   

    if($name)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($libelleGame)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($creator)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($studio)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($traduction)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($commentary)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($note)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    

    
    if(!in_array(false, $error))
    {
        $game = new Game($name, $libelleGame, $creator, $studio, $traduction, $category, $plateform, $commentary, intval($note));
        $game->insertNewGame($game);   
    }

    $category = new Category();
    $plateform = new Plateform();
    $listeCategory = $category->showAllCategories();
    $listePlateform = $plateform->showAllPlateforms();
    securityForSuperAdmin();
        
?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once ("../../partials/header.php") ?>
    <br>
    <h1 style="text-align: center">ajouter un produit au site</h1>
    <br>

    <div class="product" >
        <form method="post" >
            <h2>entrez un jeu</h2>
            <br>
            <label for="acronyme">Acronyme jeu </label>
            <input type="text" name="acronyme">
            <label for="nom-jeu">Nom jeu</label>
            <input type="text" name="nom" >
            <label for="createur">Createur</label>
            <input type="text" name="createur">
            <label for="studio">Studio</label>
            <input type="text" name="studio">
            <label for="langue">Langues</label>
            <input type="text" name="langue">
            <br>
            <label for="genre">categorie </label>
            <select name="genre">
               <?php foreach($listeCategory as $key => $value) : ?>
                    <option value="<?= $value["libelle_genre"] ?>"><?= $value["libelle_genre"] ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <label for="plateforme">plateforme </label>
            <select name="plateforme">
               <?php foreach($listePlateform as $key => $values) : ?>
                    <option value="<?= $values["libelle_plateforme"] ?>"><?= $values["libelle_plateforme"] ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <label for="commentaire">commentaire</label>
            <textarea rows="4" cols="50" name="commentaire" placeholder="Entrez votre commentaire ici..."></textarea>
            <label for="note">note</label>
            <select name="note" id="">
                <?php for ($i=0; $i <= 20; $i++) :?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor?>
            </select>
            <br>
            <button type="submit">soumettre</button>
        </form>
    </div>
    
</body>
</html>