<?php

namespace Oquiz\Models;

class QuizModel {

  private $id;
  private $title;
  private $description;
  private $id_author;

    // retourne tous les enregistrements
    public static function findAll() {

        // on récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT *, quizzes.id AS id, CONCAT(users.first_name, " " , users.last_name) AS author
        FROM quizzes INNER JOIN users ON users.id = quizzes.id_author';
        // on exécute la requête dans la BDD
        $statement = $connexion->query($sql);

        // on retourne tous les résultats
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    // retourne la valeur du champ author créé dans findAll
    public function getAuthor() {
        return $this->author;
    }

    // retourne un enregistrement à partir de son id
    public static function findById($id) {

        // on récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT *, quizzes.id AS id, CONCAT(users.first_name, " " , users.last_name) AS author
        FROM quizzes INNER JOIN users ON users.id = quizzes.id_author WHERE quizzes.id=:id';

        // on prépare la requête
        $statement = $connexion->prepare( $sql );
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        // on exécute la requête
        $statement->execute();

        // on retourne le résultat
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $statement->fetch();
    }

    // retourne tous les quiz créés par un auteur à partir de son id
    public static function findByAuthor($id) {

        // on récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT *, quizzes.id AS id,CONCAT(users.first_name, " " , users.last_name) AS author
        FROM quizzes INNER JOIN users ON users.id = quizzes.id_author WHERE users.id=:id';

        // on prépare la requête
        $statement = $connexion->prepare( $sql );
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        // on exécute la requête
        $statement->execute();

        // on retourne tous les résultats
        return $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    // vérifie les données de création de quiz
    public static function checkData($data) {

        $errors = [];
        // on liste les champs obligatoires et on vérifie qu'ils sont remplis
        $mandatoryFields = [
            'title' =>"Le titre n'est pas renseigné",
            'description' =>"La description n'est pas renseignée"
        ];
        foreach($mandatoryFields as $field => $msg)  {
            if (empty($data[$field]))  {
                $errors[] = $msg;
            }
        }
        // on vérifie que le titre n'est pas déjà utilisé
        $title = self::findByTitle($data['title']);
        if ($title !== false) {
            $errors[] = "Il existe déjà un quiz avec ce titre";
        }
        // on retourne la liste des erreurs
        return $errors;
    }

    // recherche s'il y a un quiz dans la BDD à partir de son titre
    public static function findByTitle($title) {
        // récupère la connexion à la BDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT * from quizzes WHERE title LIKE :title';
        $statement = $connexion->prepare($sql);
        $statement->bindValue(':title', $title, \PDO::PARAM_STR);
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
        $sql = 'INSERT INTO quizzes (title, description, id_author) VALUES (:title, :description, :id_author)';
        // remplace les valeurs
        $statement = $connexion->prepare($sql);
        $statement->bindValue(':title', $this->title, \PDO::PARAM_STR);
        $statement->bindValue(':description', $this->description, \PDO::PARAM_STR);
        $statement->bindValue(':id_author', $this->id_author, \PDO::PARAM_STR);
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
     * Get the value of Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of Id Author
     *
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * Set the value of Id Author
     *
     * @param mixed id_author
     *
     * @return self
     */
    public function setIdAuthor($id_author)
    {
        $this->id_author = $id_author;

        return $this;
    }

}
