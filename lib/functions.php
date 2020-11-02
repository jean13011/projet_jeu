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
function sessionsSignIn()
{
    if(!$_SESSION["connected"]){

        $_SESSION['notConnected'] = 'Veuillez vous connecter';
        header("location:connexion.php");
        die();
    } 

}

/**
 * all sessions's conditions for the sign up
 *
 */
function sessionSignUp()
{
    if( isset($_SESSION["short"]) ){
        echo $_SESSION["short"];
        session_unset();
    }

    if( isset($_SESSION["created"]) ){
        echo $_SESSION["created"];
        session_unset();
    }

    if( isset($_SESSION["envahisseur"]) ){
        echo $_SESSION["envahisseur"];
        session_unset();
    }

    if( isset($_SESSION["WrongId"]) ){
        echo $_SESSION["WrongId"];
        session_unset();
    }

    if( isset($_SESSION["notConnected"]) ){
        echo $_SESSION["notConnected"];
        session_unset();
    }
}

/**
 * display an error if passwords are not matching
 *
 * 
 */
function displayIdenticalPasswordError()
{
    if(isset($_SESSION["nonIdentique"]))
    {
        echo $_SESSION["nonIdentique"];
        session_unset();
    }

    if(isset($_SESSION["tooShort"]))
    {
        echo $_SESSION["tooShort"];
        session_unset();
    }
}

/**
 * sessions's conditions for the mail if he is actually use 
 *
 * 
 */
function displayEmailTakenOrIncomplete()
{
    if( isset($_SESSION["alreadyExist"]))
    {
            echo $_SESSION["alreadyExist"];
            session_unset();
    }
    
    if( isset($_SESSION["incomplete"]))
    {
        echo $_SESSION["incomplete"];
        session_unset();
    } 
}

function checkForDeleteUser($user)
{
    if(isset($_POST["deleteUser"]))
    {
        $user->deleteUser();
    }
    
}  

function remember($resultat)
{
    
    setcookie('mail', $resultat["mail_user"], time()+365*24*3600, null, null, false, true);
    setcookie('password', $resultat["mot_de_passe_user"], time()+365*24*3600, null, null, false, true);

    return true;
}