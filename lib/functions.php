<?php 

include_once (dirname(dirname(ROOT))) . "/classes/user/User.php";

$user = new User ;


function regexPassword($input){
        
    $subject = $input;
    $pattern = "/[0-9\&\"\'\(\-\_à\)=]/";

    if(preg_match($pattern,$subject)){

        return false;
        
    }else{
        
        return true;
    }
}


/**
* affiche le nom du jeu et son genre dans la recherche 
*/
function display($user){

    if(isset($_GET["q"]) && !empty($_GET["q"])){

        $req = $user->articles($_GET["q"]);

        foreach($req as $key => $values){
 
           echo 
                        "<p> <strong>Nom du jeu: </strong>" . $values["libelle_jeu"] . "<br>" .
                        "<strong>Genre: </strong> " . $values["genre_jeu"] . "<br>" . 
                        "<strong>Plateformes: </strong>" . $values["libelle_plateforme"] . "</p>";          
        }
    }
}

/**
 * set the pseudo of the user which is passed in the $_SESSION for using it in the menu
 *
 * @return string
 */
function setPseudoForUser()
{
    $infoUser = $_SESSION['user'];
    $pseudo = $infoUser["pseudo_user"];

    return $pseudo;
}


/**
 * sessions conditions
 *
 */
function sessions()
{
    if(!$_SESSION["connected"]){

        $_SESSION['notConnected'] = 'Veuillez vous connecter';
        header("location:./connexion.php");
        die();
    } 

    if( isset($_SESSION["passChanged"]) ){
        echo $_SESSION["passChanged"];
        session_unset();
    }
}