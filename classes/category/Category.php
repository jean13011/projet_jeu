<?php
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);

include_once dirname(ROOT) . DS. "model/Model.php";

class Category extends Model
{

    private string $nameGenre;

    /**
     * show all the categories for the games
     * 
     * @return array
     */
    public function showAllCategories()
    {
        $req = $this->pdo->prepare("SELECT * FROM `genre` ORDER BY libelle_genre ASC ");
        $req->execute();
        $result = $req->fetchAll();

        return $result;
    }
}