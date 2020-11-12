<?php

@define('ROOT', __DIR__);
@define('DS', DIRECTORY_SEPARATOR);

include_once dirname(ROOT) . DS. "model/Model.php";

class Plateform extends Model
{

    private string $namePlateform;

    /**
     * show all the plateforms for the games
     * 
     * @return array
     */
    public function showAllPlateforms()
    {
        $req = $this->pdo->prepare("SELECT * FROM `plateforme` ORDER BY libelle_plateforme ASC ");
        $req->execute();
        $result = $req->fetchAll();
        
        return $result;
    }
}