<?php
    session_start();

    require_once '../../classes/category/Category.php';
    require_once '../../classes/plateform/Plateform.php';
    require_once '../../classes/game/Game.php';
    require_once '../../lib/functions.php';

    $name = filter_input(INPUT_POST, 'acronyme');
    $libelleGame = filter_input(INPUT_POST, 'nom');
    $creator = filter_input(INPUT_POST, 'createur');
    $studio = filter_input(INPUT_POST, 'studio');
    $traduction = filter_input(INPUT_POST, 'langue');
    $category = filter_input(INPUT_POST, 'genre');
    $plateform = filter_input(INPUT_POST, 'plateforme');
    $commentary = filter_input(INPUT_POST, 'commentaire');
    $note = filter_input(INPUT_POST, 'note');
    
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
    
    if(!in_array(false, $error, true))
    {
        $name_img = $_FILES['image']['name'];
        $path_img = $_FILES['image']['tmp_name'];
        
        $image = copy($path_img, dirname(dirname(__DIR__)) . "/img-storage/" . $name_img);
        
        
        if($_FILES["image"]["error"] === 0 )
        {
            $game = new Game($name, $libelleGame, $creator, $studio, $traduction, $category, $plateform, $commentary, (int)$note, $name_img, $path_img);
            $game->insertNewGame($game);
        }

        else
        {
            echo "photo trop volumineuse";
            
        }
            
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
        <form method="post" enctype="multipart/form-data">
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
            <label for="genre">categorie</label>
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
                <?php for ($i = 1 ; $i <= 20; $i++) :?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor?>
            </select>
            <br>
            <input type="hidden" name="MAX_FILE_SIZE" value="250000"/>
            <label for="image">ajoutez une image</label>
            <input type="file" name="image" size=50/>
            <br>
            <button type="submit">soumettre</button>
            
        </form>  
    </div>
    
</body>
</html>