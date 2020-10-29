<?php
define('ROOT', __DIR__);
define('DS', DIRECTORY_SEPARATOR);


include_once (dirname(ROOT). DS."model/Model.php");



class User extends Model
{
    
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

    public function __construct(string $p='', string $m='', string $ps='')
    {

        $this->pseudo=$p;
        $this->email=$m;
        $this->password=$ps;
        parent::__construct();
    }

    /**
     * confirme le mot de passe si c'est bon on insert
     *
     * @param string $password
     * 
     * @param string $confirmPassword
     */
    public function comparePassword($password, $confirmPassword)
    {
        if($password !== $confirmPassword)
        {
            session_start();
            $_SESSION["nonIdentique"] = "<p style='color: red;'>mot de passe non identique</p>";
            header("location:inscription.php");
            die();
        }
        elseif(strlen($password) < 4 )
        {
            session_start();
            $_SESSION["tooShort"] = "<p style='color: red;'>mot de passe trop court</p>";
            header("location:inscription.php");
            die();
        }
        return false;
    }

    /**
     * vérification e-mail deja utilisé ou non
     * 
     * @param input 
    */
    public function checkMailForSignUp()
    {

        $req = $this->pdo->prepare("SELECT * FROM `user` WHERE mail_user = :mail OR pseudo_user = :pseudo");
        $req->execute([
            'mail' => $this->email,
            'pseudo' => $this->pseudo
            ]); 
        $resultat = $req->fetch();

        if(is_array($resultat))
        {
            session_start();
            $_SESSION["alreadyExist"] = "<p style='color: red;'>compte existant</p>";
            header("location:inscription.php");
            die();
        }
        else
        {
            session_start();
            $_SESSION["created"] = "compte créé connecte toi ";
            header("location:connexion.php");
        }
    }

    

    /**
     * encodage du mot de passe
     * 
     * @param input password
     * 
     * @return password_hash 
    */
     public function hashPassword()
     {
        $passHash = password_hash($this->password, PASSWORD_DEFAULT);
        return $passHash;
    }

    /**
     * insertion dans la base de données
     * 
     * @param password_hash
     *  
    */ 
    public function insertNewUser($passHash, $user,$key)
    {
        $req = $this->pdo->prepare("INSERT INTO `user` (pseudo_user, mail_user, mot_de_passe_user,vkey) VALUES (:pseudo, :mail, :password, :key)"); 

        $req->bindParam(':pseudo', $this->pseudo);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':password', $passHash);
        $req->bindParam(':key', $key);
        
        $req->execute();
    } 

    /**
     * verification mail dans la base de données 
     * 
     * @return array|false retourne un tableau avec 1 
     * utilisateur ou false si il ne trouve rien
    */
    public function checkMailForSignIn()
    {

    
        $req = $this->pdo->prepare("SELECT * FROM `user` WHERE mail_user = :mail " ); 

        $req->execute([
            'mail' => $this->email
            
        ]);
        
        return $req->fetch();
    }

    /**
     * Comparaison du pass envoyé via le formulaire avec la base 
     * 
     * @var bool $isPasswordCorrect verification mot de passe auprès de la Bdd 
     * 
     * @param array|false $resultat Le resultat retourné par la fonction userInput() qui contient un utilisateur ou rien 
     * 
     * @param array $input un array de type $_POST
     * 
     * @param void
    */
    public function comparePasswordInDB($resultat)
    {

        if (is_array($resultat))
        {
            $isPasswordCorrect = password_verify($this->password, $resultat["mot_de_passe_user"]);

            if ($isPasswordCorrect) 
            {
                session_start();
                
                $_SESSION['user'] = $resultat;
                $_SESSION["connected"] = true;
                header("location:home.php");
            }
            else 
            {
                session_start();
                $_SESSION["WrongId"] = "verifiez votre mdp";
                header("location:connexion.php");
                die();
            }
        }
        else
        {
            session_start();
            $_SESSION["WrongId"] = "verifiez votre adresse!";
            header("location:connexion.php");
            die();
        }
    }

    /**
    * l'utilisateur rentre une recherche et on etablie le lien avec la bdd
    * 
    * @return array
    */
    public function articles($input)
    {

        $sql = 'SELECT libelle_jeu, genre_jeu, libelle_plateforme FROM jeu WHERE libelle_jeu LIKE "%'.$input.'%" OR genre_jeu like "%'.$input.'%" ORDER BY id_jeu DESC ';
        $articles = $this->pdo->prepare($sql);

        $articles->execute();

        return $articles->fetchAll();
    }

    /**
     * vérifie dans la bdd les données liée a l'id rentré
     * 
     * @return array $resultat pour la comparaison
     * 
     * @return false if error
     */
    public function checkId()
    {

        $userId = $_SESSION["user"]["id_user"];

        $pdo = $this->pdo->prepare("SELECT * FROM `user` WHERE id_user = :id" ); 
        $pdo->execute([
            'id' => $userId,
        ]);
        
        return $pdo->fetch();
    }

    /**
     * match du pass rentrée avec le $resultat de la fonction précedente
     
     * 
     * @param $resultat qui renvoi true|false selon la reponse
     * 
     * @param string  $passHash
     * 
     */
    public function changePassword($resultat, $passHash)
    {
        if (is_array($resultat)) 
        {
            $password = $resultat["mot_de_passe_user"];

            $isPasswordCorrect = password_verify($_POST["currentPassword"], $password);
            if($_POST["currentPassword"] === $this->password)
            {
                session_start();
                    $_SESSION["samePass"] = "mot de passe identique";
                    header("location:home.php");
                    die();

            } if (!$isPasswordCorrect)
            {
                    
                session_start();
                $_SESSION["wrongPass"] = "mot de passe incorrect";
                header("location:changePass.php");
                die();
            }

             else 
            {
                $newPassword = $passHash;
                $userId = $_SESSION["user"]["id_user"];
                $sql = "
                UPDATE user
                SET mot_de_passe_user = :password
                WHERE id_user = :id
                ";
    
                $query = $this->pdo->prepare($sql);
                $exec = $query->execute([
                    'id' => $userId,
                    'password' => $newPassword,
                ]);
            }
        }
        return true;
    }

    /**
     * renvoie vers le profil si le mot de passe est changé
     *
     * @param bool $req
     */
    public function addedPassword($req)
    {

        if ($req == true )
        {
            
            session_start();
            $_SESSION["passChanged"] = "mot de passe changé";
            header("location:profilUser.php");

        } else {
            echo " connexion à la BDD echouée ";
        }
    } 
    
         
}