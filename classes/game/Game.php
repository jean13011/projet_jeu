<?php
@define('ROOT', __DIR__);
@define('DS', DIRECTORY_SEPARATOR);

include_once dirname(ROOT) . DS. "model/Model.php";

class Game extends Model
{

    private string $name;
    private string $libelleGame;
    private string $creator;
    private string $studio;
    private string $traduction;
    private string $category;
    private string $plateform;
    private string $commentary;
    private int $note;

    public function __construct(string $n, string $lg, string $c, string $s, string $t, string $cat, string $p, string $com, int $not)
    {

        $this->name=$n;
        $this->libelleGame=$lg;
        $this->creator=$c;
        $this->studio=$s;
        $this->traduction=$t;
        $this->category=$cat;
        $this->plateform=$p;
        $this->commentary=$com;
        $this->note=$not;
        parent::__construct();
    }

    /**
     * Get the value of name
     *
    */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
    */ 
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the value of libelle
     *
    */ 
    public function getLibelleGame()
    {
        return $this->libelleGame;
    }

    /**
     * Set the value of libelleGame
     *
     * @return  self
    */ 
    public function setLibelleGame($libelleGame)
    {
        $this->libelleGame = $libelleGame;
        return $this;
    }

    /**
     * Get the value of creator
     *
    */ 
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set the value of creator
     *
     * @return  self
    */ 
    public function setCreator($creator)
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Get the value of studio
     *
    */ 
    public function getStudio()
    {
        return $this->studio;
    }

    /**
     * Set the value of studio
     *
     * @return  self
    */ 
    public function setStudio($studio)
    {
        $this->studio = $studio;
        return $this;
    }

    /**
     * Get the value of traduction
     *
    */ 
    public function getTraduction()
    {
        return $this->traduction;
    }

    /**
     * Set the value of traduction
     *
     * @return  self
    */ 
    public function setTraduction($traduction)
    {
        $this->traduction = $traduction;
        return $this;
    }

    /**
     * Get the value of genre
     *
    */ 
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @return  self
    */ 
    public function setGenre($genre)
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * Get the value of plateform
     *
    */ 
    public function getPlateform()
    {
        return $this->plateform;
    }

    /**
     * Set the value of plateform
     *
     * @return  self
    */ 
    public function setPlateform($plateform)
    {
        $this->plateform = $plateform;
        return $this;
    }



    
/**
 * insert the new game in DB 
 * 
 * @param object  game
 */
    public function insertNewGame($game)
    {

        $sql = "INSERT INTO `jeu` (nom_jeu, libelle_jeu, createur_jeu, studio_jeu, langue_jeu, genre_jeu, libelle_plateforme, commentaire, note, id_img) 
                VALUES (:name, :libelleGame, :creator, :studio, :traduction, :category, :plateform, :commentary, :note, :img)
                ";
        $req= $this->pdo->prepare($sql);
        $req->execute([
            "name" => $this->name,
            "libelleGame" => $this->libelleGame,
            "creator" => $this->creator,
            "studio" => $this->studio,
            "traduction" => $this->traduction,
            "category" => $this->category,
            "plateform" => $this->plateform,
            "commentary" => $this->commentary,
            "note" => $this->note,
            "img" => $this->insertNewImage()
        ]);
    }

    /**
     * 
     */
    public function insertNewImage()
    {
        $name = $_FILES['image']['name'];
        $image = $_FILES['image']['tmp_name'];
        $path = file_get_contents($image);

        $req = $this->pdo->prepare("INSERT INTO `img` (nom_img, path_img) VALUES (:name, :path)");
        $req->execute([
            "name" => $name,
            "path" => $path
        ]);
    }
}