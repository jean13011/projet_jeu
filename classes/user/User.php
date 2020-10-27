<?php
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);


include_once (dirname(ROOT). DS."model/Model.php");



class User extends Model
{
    private string $name;
    private string $firstName;
    private string $pseudo;
    private string $email;
    private string $password;

        /**
     * Get the value of id
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of name
     *
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @return  self
     */ 
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }    

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password =$password;
        return $this;
    }

    public function __construct(string $n='', string $fn='', string $p='', string $m='', string $ps='')
    {

        $this->name=$n;
        $this->firstName=$fn;
        $this->pseudo=$p;
        $this->email=$m;
        $this->password=$ps;
        parent::__construct();
    }

  

    /**
     * vérification e-mail deja utilisé ou non
     * 
     * @param input 
     */
    public function checkMail(){

        $req = $this->pdo->prepare("SELECT * FROM `user` WHERE mail_user = :mail");
        $req->execute(array(
            'mail' => $this->email
        )); 
        $resultat = $req->fetch();

        if(is_array($resultat))
        {
            session_start();
            $_SESSION["alreadyExist"] = "compte existant";
            header("location:../inscription.php");
            die();
        }
        else
        {
            session_start();
            $_SESSION["created"] = "compte créé connecte toi ";
            //header("location:../inscription.php");
        }
    }

    /**
     * encodage du mot de passe
     * 
     * @param input password
     * 
     * @return password_hash 
     */
     public function hashPassword(){
        $passHash = password_hash($this->password, PASSWORD_DEFAULT);
        return $passHash;
    }

    /**
     * insertion dans la base de données
     * 
     * @param password_hash
     *  
    */ 
    public function insertInBdd($passHash,$user){
        $req = $this->pdo->prepare("INSERT INTO `user` (nom_user, prenom_user, pseudo_user, mail_user, mot_de_passe_user) VALUES (:nom, :prenom, :pseudo, :mail, :password)"); 

        
        $req->bindParam(':nom', $this->name);
        $req->bindParam(':prenom', $this->firstName);
        $req->bindParam(':pseudo', $this->pseudo);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':password', $passHash); 
        
        $req->execute();
    } 

    /**
    * verification de connexion reussite ou non 
    * 
    *@param PDO 
    */
    static function createAccount($pdo){

        if ($pdo == true){
            echo "connexion à la BDD reussite.";
            header("location:../connexion.php");
        } else {
            echo " connexion à la BDD echouée ";
        }
    } 
    /**
     * verification nom dans la base de données 
     * 
     * @return array|false retourne un tableau avec 1 
     * utilisateur ou false si il ne trouve rien
     */
    public function checkInBdd(){

    
        $req = $this->pdo->prepare("SELECT * FROM `user` WHERE mail_user = :mail" ); 

        $req->execute([
            'mail' => $this->email
        ]);
        
        return $req->fetch();
    }
}