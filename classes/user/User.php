<?php

@define('ROOT', __DIR__);
@define('DS', DIRECTORY_SEPARATOR);


include_once (dirname(ROOT). DS."model/Model.php");

class User extends Model
{
    
    private string $pseudo;
    private string $email;
    private string $password;
    private int  $accreditation = 1 ;

    
    public function __construct(string $p='', string $m='', string $ps='')
    {

        $this->pseudo=$p;
        $this->email=$m;
        $this->password=$ps;
        parent::__construct();
    }

    /**
     * Get the value of pseudo
     *
    */ 
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param $pseudo
     * @return  self
     */
    public function setPseudo($pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    /**
     * Get the value of email
    */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
    */ 
    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }    

    /**
     * Get the value of password
    */ 
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): \User
    {
        $this->password = $password;
        return $this;
    }

   


    //INSCRIPTION USER ***********************************************

    /**
     * confirm the password if both password are corresponding we can continue
     *
     * @param string $password
     *
     * @param string $confirmPassword
     *
     * @return bool
     */
    public function comparePassword(string $password, string $confirmPassword): bool
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
     * check if the mail is already used 
     * 
    */
    public function checkMailForSignUp(): void
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
     * hashing password
     * 
     * 
     * @return string password_hash 
    */
     public function hashPassword(): string
     {
         return password_hash($this->password, PASSWORD_DEFAULT);
    }

    /**
     * insert all datas in the DB
     *
     * @param password_hash
     *
     */
    public function insertNewUser($passHash): void
    {

        if(isset($_SESSION["user"]["accreditation"]) && (int)$_SESSION["user"]["accreditation"] === 200)
        {
            
            $this->accreditation = 100;
        }

        $req = $this->pdo->prepare("INSERT INTO `user` (pseudo_user, mail_user, mot_de_passe_user, accreditation) VALUES (:pseudo, :mail, :password, :accreditation)"); 

        $req->bindParam(':pseudo', $this->pseudo);
        $req->bindParam(':mail', $this->email);
        $req->bindParam(':password', $passHash);
        $req->bindParam(':accreditation', $this->accreditation);
        
        $req->execute();
    } 

    //CONNEXION USER ***************************************

    /**
     * check the mail in the DB
     * 
     * @return array
    */
    public function checkMailForSignIn(): array
    {

    
        $req = $this->pdo->prepare("SELECT * FROM `user` WHERE mail_user = :mail " ); 

        $req->execute([
            'mail' => $this->email
            
        ]);
        
        return $req->fetch();
    }

    /**
     * comparing the enter password in the DB to see if its matching
     * 
     * @var bool $isPasswordCorrect check data in DB 
     * 
    */
    public function comparePasswordInDB($resultat): void
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
    * search in the searchbar
    * 
    * @return array
    */
    public function articles($input): array
    {

        $sql = 'SELECT libelle_jeu, genre_jeu, libelle_plateforme FROM jeu WHERE libelle_jeu LIKE "%'.$input.'%" OR genre_jeu like "%'.$input.'%" ORDER BY id_jeu DESC ';
        $articles = $this->pdo->prepare($sql);

        $articles->execute();

        return $articles->fetchAll();
    }

    //UPDATE USER ******************************************

    /**
     * check in DB all infos for the id entered
     * 
     * @return array $resultat pour la comparaison
     * 
     * @return false if error
     */
    public function checkId(): array
    {

        $userId = $_SESSION["user"]["id_user"];

        $pdo = $this->pdo->prepare("SELECT * FROM `user` WHERE id_user = :id" ); 
        $pdo->execute([
            'id' => $userId,
        ]);
        
        return $pdo->fetch();
    }

    /**
     * change de password if is not identical to the old one
     *
     * @param $resultat qui renvoi true|false selon la reponse
     *
     * @param string $passHash
     *
     * @return bool
     */
    public function changePassword($resultat, string $passHash): bool
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
     * send to home.php if the previous action is good
     *
     * @param bool $req
     */
    public function addedPassword($req): void
    {

        if ($req == true)
        {
            
            session_start();
            $_SESSION["passChanged"] = "mot de passe changé";
            header("location:profilUser.php");

        } else {
            echo " connexion à la BDD echouée ";
        }
    } 

    /**
     * update the pseudo 
     */
    public function changePseudo(): void
    {
        
        if($_POST["currentPseudo"] !== $this->pseudo)
        {
            $sql = "UPDATE `user` SET
                    pseudo_user = :pseudo 
                    WHERE id_user = :id";

            $userId = $_SESSION["user"]["id_user"];
            $req = $this->pdo->prepare($sql);
            $req->execute([
                "pseudo" => $this->pseudo,
                "id" => $userId
            ]);
            session_start();
            $_SESSION["pseudoChanged"] = "pseudo changé";
            header("location:profilUser.php");
        } else {

            echo "pseudo identiques";
        }
    }

    /**
     * delete the user
     */
    public function deleteUser(): void
    {
        
            $userId = $_SESSION["user"]["id_user"];
            $sql = "DELETE FROM `user`
                    WHERE id_user = :id";
            
            $req = $this->pdo->prepare($sql);
            $req->execute([
                "id" => $userId
            ]);
            
            session_start();
            $_SESSION["userDeleted"] = "compte supprimé";
            header("location:inscription.php");
    }  

    //Admin ***********************************************

    /**
     * enter a name or role and it find all user corresponding to the search
     * @param $pseudo
     * @param $email
     * @param $role
     * @return array
     */
    public  function findUsers($pseudo, $email, $role): array
    {

        $sql = "SELECT * FROM `user` 
                INNER JOIN `accreditation`
                ON user.accreditation = accreditation.accreditation
                WHERE pseudo_user like :pseudo 
                AND mail_user like :mail
                AND nom_accreditation like :role";

        $result  = $this->pdo->prepare($sql);

       //concaténation pour le LIKE
       $pseudo="%".$pseudo."%";
       $email="%".$email."%";
       $role="%".$role."%";

       $result->bindParam(":pseudo", $pseudo);
       $result->bindParam(":mail", $email);
       $result->bindParam(":role", $role);

       $result->execute();

        return $result->fetchAll();
   }

    /**
     * delete the user
     *
     * @param string
     * @return bool
     */
   public function delete($id): bool
   {

       $result = $this->pdo->prepare("DELETE FROM `USER` WHERE id_user = :id");
       
      return  $result->execute([
          "id" => $id
      ]);

    }

    /**
     * upgrade the lambda user
     * 
     * @param int id
     */
    public function upgrade($id): void
    {
        $req = $this->pdo->prepare("UPDATE `user` SET accreditation = 100 WHERE id_user = :id");
        $req->execute([
            "id" => $id
        ]);
        
        session_start();
        $_SESSION['upgrade'];
        header("location:displayUsers.php");
    }
}