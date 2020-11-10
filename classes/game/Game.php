<?php
@define('ROOT', __DIR__);
@define('DS', DIRECTORY_SEPARATOR);

include_once dirname(ROOT) . DS. "model/Model.php";

class Game extends Model
{

    protected int $id;
    protected string $name;
    protected string $libelleGame;
    protected string $creator;
    protected string $studio;
    protected string $traduction;
    protected string $genre;
    protected int $note;
    protected string $commentary;


    
}