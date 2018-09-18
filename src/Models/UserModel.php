<?php

namespace Oquiz\Models;

class UserModel {

  private $id;
  private $first_name;
  private $last_name;
  private $email;
  private $password;

    // vérifie s'il y a un utilisateur dans la BDD avec cet email/ ce password -> retourne un booleen
    public static function checkAccount($email, $password) {

        // récupère les données de l'utilisateur si l'email existe dans la BDD : appelle findByEmail
        $user = self::findByEmail($email);

        if ($user) {
            // on a un utilisateur qui correspond
            $isOK = password_verify($password, $user->getPassword());
            if($isOK) {
                // mot de passe correct : on continue
                return $user;
            } else {
                // mot de passe incorrect
                return false;
            }
        } else {
            // utilisateur inconnu
            return false;
        }
    }

    // crée la session de l'utilisateur
    public static function connect($user) {

        // on stocke en session les infos dont on aura besoin
      $_SESSION['user'] = [
        'id'=> $user->getId(),
        'firstname'=> $user->getFirstname(),
        'email'=>$user->getEmail()
      ];
    }

    // indique si l'utilisateur est connecté
    public static function isConnected() {
        return isset($_SESSION['user']);
    }

    // renvoie les données de l'utilisateur connecté
    public static function getUser() {

        // si l'utilisateur n'est pas connecté -> false
        if (!isset($_SESSION['user'])) return false;
        // on transforme $_SESSION['user'] en objet
        return (object) $_SESSION['user'];
    }

    // déconnecte l'utilisateur
    public static function disconnect() {
        unset($_SESSION['user']);
        session_destroy();
    }

    // vérifie les données de création de compte
    public static function checkData($data) {

        $errors = [];
        // on liste les champs obligatoires et on vérifie qu'ils sont remplis
        $mandatoryFields = [
            'firstname' =>"Le prénom n'est pas renseigné",
            'lastname' =>"Le nom n'est pas renseigné",
            'password' =>"Le mot de passe n'est pas renseigné"
        ];
        foreach($mandatoryFields as $field => $msg)  {
            if (empty($data[$field]))  {
                $errors[] = $msg;
            }
        }
        // on vérife que les 2 password sont identiques
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = "Les deux mots de passe ne sont pas identiques";
        }
        // on verifie le format de l'Email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse mail n'est pas valide";
        }
        // on vérifie que l'adresse mail n'est pas déjà utilisée
        $user = self::findByEmail($data['email']);
        if ($user !== false) {
            $errors[] = "Il existe déjà un compte pour cette adresse mail";
        }
        // on retourne la liste des erreurs
        return $errors;
    }

    // recherche s'il y a un utilisateur dans la BDD à partir de son email
    public static function findByEmail($email) {
        // récupère la connexion à la BDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT * from users WHERE email LIKE :email';
        $statement = $connexion->prepare($sql);
        $statement->bindValue(':email', $email, \PDO::PARAM_STR);
        // exécute la requête dans la BDD
        $statement->execute();
        // récupère le résultat
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $statement->fetch(\PDO::FETCH_CLASS);
    }

    // enregistre les données en BDD
    public function save() {
        // récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)';
        // remplace les valeurs
        $statement = $connexion->prepare($sql);
        $statement->bindValue(':firstname', $this->first_name, \PDO::PARAM_STR);
        $statement->bindValue(':lastname', $this->last_name, \PDO::PARAM_STR);
        $statement->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $statement->bindValue(':password', $this->password, \PDO::PARAM_STR);
        // exécute la requête dans la BDD
        $error = $statement->execute();
        // retourne les erreurs éventuelles
        return $error;
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of First Name
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set the value of First Name
     *
     * @param mixed first_name
     *
     * @return self
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of Last Name
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set the value of Last Name
     *
     * @param mixed last_name
     *
     * @return self
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of Email
     *
     * @param mixed email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of Password
     *
     * @param mixed password
     *
     * @return self
     */
    public function setPassword($password)
    {
        // hash du password
        $this->password = password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

}
