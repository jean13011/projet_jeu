<?php 


$upgrade = null;


require_once ("../../classes/user/User.php");
require_once ("../../lib/functions.php");

$upgrade = new User;


$id = $_GET["id"];
$req = $upgrade->upgrade($id);

if($req)
{
    

} else {

    "erreur!";
}