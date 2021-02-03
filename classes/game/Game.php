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
    private string $name_img;
    private string $path_img;

    public function __construct(string $n, string $lg, string $c, string $s, string $t, string $cat, string $p, string $com, int $not, string $ni, string $pi)
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
        $this->name_img=$ni;
        $this->path_img=$pi;
        parent::__construct();
    }

    /**
     * Get the value of name
     *
    */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param $name
     * @return  self
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * Get the value of libelle
     *
    */ 
    public function getLibelleGame(): string
    {
        return $this->libelleGame;
    }

    /**
     * Set the value of libelleGame
     *
     * @param $libelleGame
     * @return  self
     */
    public function setLibelleGame($libelleGame): Game
    {
        $this->libelleGame = $libelleGame;
        return $this;
    }

    /**
     * Get the value of creator
     *
    */ 
    public function getCreator(): string
    {
        return $this->creator;
    }

    /**
     * Set the value of creator
     *
     * @param $creator
     * @return  self
     */
    public function setCreator($creator): Game
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * Get the value of studio
     *
    */ 
    public function getStudio(): string
    {
        return $this->studio;
    }

    /**
     * Set the value of studio
     *
     * @param $studio
     * @return  self
     */
    public function setStudio($studio): self
    {
        $this->studio = $studio;
        return $this;
    }

    /**
     * Get the value of traduction
     *
    */ 
    public function getTraduction(): string
    {
        return $this->traduction;
    }

    /**
     * Set the value of traduction
     *
     * @param $traduction
     * @return  self
     */
    public function setTraduction($traduction): Game
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
     * @param $genre
     * @return  self
     */
    public function setGenre($genre): self
    {
        $this->genre = $genre;
        return $this;
    }

    /**
     * Get the value of plateform
     *
    */ 
    public function getPlateform(): string
    {
        return $this->plateform;
    }

    /**
     * Set the value of plateform
     *
     * @param $plateform
     * @return  self
     */
    public function setPlateform($plateform): Game
    {
        $this->plateform = $plateform;
        return $this;
    }

/**
 * insert the new game in DB 
 * 
 * @param object  game
 */
    public function insertNewGame($game): void
    {

        $sql = "INSERT INTO `jeu` (nom_jeu, libelle_jeu, createur_jeu, studio_jeu, langue_jeu, genre_jeu, libelle_plateforme, commentaire, note, nom_img, path_img) 
                VALUES (:name, :libelleGame, :creator, :studio, :traduction, :category, :plateform, :commentary, :note, :image, :path)
                ";
        $req = $this->pdo->prepare($sql);
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
            "image" => $this->name_img,
            "path" => $this->path_img
        ]);
    }

    
}