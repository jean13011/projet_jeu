<?php
    session_start();

    require_once '../../classes/genre/Genre.php';
    require_once '../../classes/plateform/Plateform.php';
    require_once '../../lib/functions.php';

    $acronyme = filter_input(INPUT_POST, 'acronyme', FILTER_DEFAULT);
    $nom = filter_input(INPUT_POST, 'nom', FILTER_DEFAULT);
    $createur = filter_input(INPUT_POST, 'createur', FILTER_DEFAULT);
    $studio = filter_input(INPUT_POST, 'studio', FILTER_DEFAULT);
    $langue = filter_input(INPUT_POST, 'langue', FILTER_DEFAULT);
    $genre = filter_input(INPUT_POST, 'genre', FILTER_DEFAULT);
    $plateforme = filter_input(INPUT_POST, 'plateforme', FILTER_DEFAULT);
   
    $title = $_SERVER["SCRIPT_NAME"];
   
    $error = [];
   

    if($acronyme)
    {
        $error[] = true;

    }else{

        $error []= false;
    }

    if($nom)
    {
        $error[] = true;

    }else{

        $error [] = false;
    }

    if($createur)
    {
        $error[] = true;
        
    }else{

        $error [] = false;
    }

    if($studio)
    {
        $error[] = true;
        
    }else{

        $error [] = false;
    }
    
    if($langue)
    {
        $error[] = true;
        
    }else{

        $error [] = false;
    }

    if($genre)
    {
        $error[] = true;
        
    }else{

        $error [] = false;
    }

    if($plateforme)
    {
        $error[] = true;
        
    }else{

        $error [] = false;
    }
    

    if(!in_array(false, $error))
    {
        
        
    }
    $genre = new Genre;
    $plateform = new Plateform;
    $listeGenre = $genre->displayGenre();
    $listePlateforme = $plateform->displayPlateform();
?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once ("../../partials/header.php") ?>
    <br>
    <h1 style="text-align: center">ajouter un produit au site</h1>
    <br>

    <div class="product" >
        <form method="post" >
            <label for="acronyme">Acronyme jeu </label>
            <input type="text" name="acronyme">
            <label for="nom-jeu">Nom jeu</label>
            <input type="text" name="nom-jeu" >
            <label for="createur">Createur</label>
            <input type="text" name="createur">
            <label for="studio">Studio</label>
            <input type="text" name="confirmstudio">
            <label for="langue">Langues</label>
            <input type="text" name="langue">
            <br>
            <select name="genre">
               <?php foreach($listeGenre as $key => $value) : ?>
                    <option value="<?= $value["id_genre"] ?>"><?= $value["libelle_genre"] ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <select name="plateforme">
               <?php foreach($listePlateforme as $key => $values) : ?>
                    <option value="<?= $values["id_plateforme"] ?>"><?= $values["libelle_plateforme"] ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <button type="submit">soumettre</button>
        </form>
    </div>
    
</body>
</html>