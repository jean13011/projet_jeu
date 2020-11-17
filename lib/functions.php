<?php 

include_once (dirname(dirname(ROOT))) . "/classes/user/User.php";
include_once (dirname(dirname(ROOT))) . "/classes/game/Game.php";

$user = new User() ;


/**
* show all infos for the searching game 
*/
function displayGames($user){

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

//INSCRIPTION ********************

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
    
    if(isset($_SESSION["alreadyConnected"]))
    {
        echo $_SESSION["alreadyConnected"];
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

function incompleteSignIn($pseudo, $email, $password, $confirmPass)
{
    if(count($_POST) > 0 && empty($idpays) && empty($nom) && empty($prenom) && empty($date))
    {

        echo "remplissez tout les champs";
    } 
        
        
    
}



//USER SPACE **************************

/**
 * if the condition is active we deleting the user from the DB
 * 
 * @param object 
 */
function checkForDeleteUser($user)
{
    if(isset($_POST["deleteUser"]) && intval($_SESSION["user"]["accreditation"]) !== 200)
    {
        $user->deleteUser();
    }
    
}  

/**
 * set cookie for the "remember me"
 * 
 * @return bool
 */
function remember($resultat)
{
    
    setcookie('mail', $resultat["mail_user"], time()+365*24*3600, null, null, false, true);
    setcookie('password', $resultat["mot_de_passe_user"], time()+365*24*3600, null, null, false, true);

    return true;
}



//ADMIN  ********************

/**
* show all info of ther users
*/
function showUser($user){

    //si au moin un POST est passe et que le button avec la valeur sub est activer alors on execute la recherche
    if(count($_POST) > 0 && isset($_POST['sub'])){

        $req = $user->findUsers($_POST["spseudo"], $_POST["smail"], $_POST["srole"]);
        $result= [];

        foreach($req as $key => $values)
        {
            $id = intval($values["id_user"]);
            $pseudo = $values["pseudo_user"];
            $accreditation = $values["nom_accreditation"];
            $nAccreditation = intval($values["accreditation"]);
            $mail = $values["mail_user"];

            if($id !== 20 && $nAccreditation !== 1 )
            {
                $result[] = 
                
                    "<div class='display-users'>" . 
                        "<p> <strong>id: </strong>" . $id . "<br>" .
                        "<strong>pseudo: </strong> " . $pseudo . "<br>" . 
                        "<strong>accreditation: </strong> " . $accreditation . "<br>" . 
                        "<strong>mail: </strong> " . $mail .  "</p>".

                       
                        "<form action='delete.php' method='post' name='suppr' >
                            <input type='hidden' name='id' value='".$values['id_user']."'>
                            <button name='delete' value=1 id='suppr' >supprimer</button>
                        </form> ".
                        
                    "</div>";
            }

            if($nAccreditation === 1)
            {
                $result[] = 
                
                    "<div class='display-users'>" . 
                        "<p> <strong>id: </strong>" . $id . "<br>" .
                        "<strong>pseudo: </strong> " . $pseudo . "<br>" . 
                        "<strong>accreditation: </strong> " . $accreditation . "<br>" . 
                        "<strong>mail: </strong> " . $mail .  "</p>".

                       
                        "<form action='delete.php' method='post' name='suppr' >
                            <input type='hidden' name='id' value='".$values['id_user']."'>
                            <button name='delete' value=1 id='suppr' >supprimer</button>
                        </form> ".
                        

                        "<form action='upgrade.php?id=".$values["id_user"]."' method='post'> 
                            <button name='upgrade' value=1>upgrade</button> 
                        </form>". 

                    "</div>";
            }

            
        }
            
        return $result;
    }
}

/**
 * add a delete button and upgrade button for lambda users
 * 
 * @param object
 */
function updateAndDeleteForAll($user)
{

    if($user){
            
        //affichage des recherche
        $value = showUser($user);

    }

    if(!isset($value)){

        return;
    }   

    for($i=0; $i<count($value) ;$i++){

        echo $value[$i];
    }
        

    if(!isset($value["id_user"])){

        return;
    }

    

}

/**
 * simple conditions for home in the super admin interface
 */

function treatments()
{
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
    if(isset($_SESSION['suppr']))
    {
        echo $_SESSION['suppr'];
    }

    if(isset($_SESSION['upgrade']))
    {
        echo "utilisateur monté en grade";
    }
}

function securityForSuperAdmin()
{
    if(!isset($_SESSION["connected"]) || $_SESSION["user"]["accreditation"] <= 100 )
    {
        session_start();
        header("location:../user/connexion.php");
        echo "page introuvable connectez-vous !!";
    }
    
}

