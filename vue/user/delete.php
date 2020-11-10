<?php 


$delete = null;


require_once ("../../classes/user/User.php");
require_once ("../../lib/functions.php");

$delete = new User;


$id = $_POST["id"];
$req = $user->delete($id);

if($req)
{
    session_start();
    $_SESSION['suppr'] = "<p style='color: red>' suppresion effectuée</p>";
    header("location:displayUsers.php");

} else {

    "erreur!";
}