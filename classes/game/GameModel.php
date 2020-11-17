<?php
@define('ROOT', __DIR__);
@define('DS', DIRECTORY_SEPARATOR);

include_once dirname(ROOT) . DS. "model/Model.php";

class GameModel extends Model
{
    /**
     * show all the game in a list with all their infos and one image
     * 
     * @return array 
     */
    public function showAllGames()
    {
        $sql = "SELECT * FROM `jeu` ";

        $req = $this->pdo->prepare($sql);
        $req->execute();
        $result = $req->fetchAll();

        return $result;
    }
}