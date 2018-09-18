<?php

namespace Oquiz\Models;

class QuestionModel {
    private $id;
    private $id_quiz;
    private $question;
    private $prop1;
    private $prop2;
    private $prop3;
    private $prop4;
    private $id_level;
    private $anecdote;
    private $wiki;

    // retourne toutes les questions d'un quiz à partir de l'id du quiz
    public static function findAllByQuiz($id) {

        // on récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT *, questions.id AS questionid, levels.id AS levelid, levels.name AS level FROM questions INNER JOIN levels ON levels.id = questions.id_level WHERE id_quiz=:id';
        // on prépare la requête
        $statement = $connexion->prepare( $sql );
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        // on exécute la requête
        $statement->execute();

        // on retourne les résultats
        $results = $statement->fetchAll(\PDO::FETCH_CLASS, static::class);
        return $results;
    }

    // retourne la réponse d'une question (prop1) à partir de son id
    public static function findAnswer($id) {

        // on récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'SELECT prop1 FROM questions WHERE id=:id';
        // on prépare la requête
        $statement = $connexion->prepare( $sql );
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        // on exécute la requête
        $statement->execute();

        // on retourne le résultat
        $statement->setFetchMode(\PDO::FETCH_CLASS, static::class);
        return $statement->fetch();
    }

    // retourne la valeur du champ level créé dans findAllByQuiz
    public function getLevel() {
        return $this->level;
    }

    // retourne la valeur de l'id du level
    public function getLevelId()
    {
        return $this->levelid;
    }
    
    // retourne la valeur de l'id de la question
    public function getQuestionId()
    {
        return $this->questionid;
    }

    // vérifie les données de création de question
    public static function checkData($data) {

        $errors = [];
        // on liste les champs obligatoires et on vérifie qu'ils sont remplis
        $mandatoryFields = [
            'question' =>"La question n'est pas renseignée",
            'prop1' =>"La proposition 1 n'est pas renseignée",
            'prop2' =>"La proposition 2 n'est pas renseignée",
            'prop3' =>"La proposition 3 n'est pas renseignée",
            'prop4' =>"La proposition 4 n'est pas renseignée",
            'anecdote' =>"L'anecdote n'est pas renseignée",
            'id_level' =>"Le niveau n'est pas renseigné",
            'wiki' =>"Le wiki n'est pas renseigné",
        ];
        foreach($mandatoryFields as $field => $msg)  {
            if (empty($data[$field]))  {
                $errors[] = $msg;
            }
        }
        // on retourne la liste des erreurs
        return $errors;
    }

    // enregistre les données en BDD
    public function save() {
        // récupère la connexion à la bDD
        $connexion = \Oquiz\Utils\Database::getDB();
        // requête de récupération de données
        $sql = 'INSERT INTO questions (question, prop1, prop2, prop3, prop4, anecdote, wiki, id_level, id_quiz) VALUES (:question, :prop1, :prop2, :prop3, :prop4, :anecdote, :wiki, :id_level, :id_quiz)';
        // remplace les valeurs
        $statement = $connexion->prepare($sql);
        $statement->bindValue(':question', $this->question, \PDO::PARAM_STR);
        $statement->bindValue(':prop1', $this->prop1, \PDO::PARAM_STR);
        $statement->bindValue(':prop2', $this->prop2, \PDO::PARAM_STR);
        $statement->bindValue(':prop3', $this->prop3, \PDO::PARAM_STR);
        $statement->bindValue(':prop4', $this->prop4, \PDO::PARAM_STR);
        $statement->bindValue(':anecdote', $this->anecdote, \PDO::PARAM_STR);
        $statement->bindValue(':wiki', $this->wiki, \PDO::PARAM_STR);
        $statement->bindValue(':id_level', $this->id_level, \PDO::PARAM_STR);
        $statement->bindValue(':id_quiz', $this->id_quiz, \PDO::PARAM_STR);
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
     * Get the value of Id Quiz
     *
     * @return mixed
     */
    public function getIdQuiz()
    {
        return $this->id_quiz;
    }

    /**
     * Set the value of Id Quiz
     *
     * @param mixed id_quiz
     *
     * @return self
     */
    public function setIdQuiz($id_quiz)
    {
        $this->id_quiz = $id_quiz;

        return $this;
    }

    /**
     * Get the value of Question
     *
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of Question
     *
     * @param mixed question
     *
     * @return self
     */
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp1()
    {
        return $this->prop1;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop1
     *
     * @return self
     */
    public function setProp1($prop1)
    {
        $this->prop1 = $prop1;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp2()
    {
        return $this->prop2;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop2
     *
     * @return self
     */
    public function setProp2($prop2)
    {
        $this->prop2 = $prop2;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp3()
    {
        return $this->prop3;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop3
     *
     * @return self
     */
    public function setProp3($prop3)
    {
        $this->prop3 = $prop3;

        return $this;
    }

    /**
     * Get the value of Prop
     *
     * @return mixed
     */
    public function getProp4()
    {
        return $this->prop4;
    }

    /**
     * Set the value of Prop
     *
     * @param mixed prop4
     *
     * @return self
     */
    public function setProp4($prop4)
    {
        $this->prop4 = $prop4;

        return $this;
    }

    /**
     * Get the value of Id Level
     *
     * @return mixed
     */
    public function getIdLevel()
    {
        return $this->id_level;
    }

    /**
     * Set the value of Id Level
     *
     * @param mixed id_level
     *
     * @return self
     */
    public function setIdLevel($id_level)
    {
        $this->id_level = $id_level;

        return $this;
    }

    /**
     * Get the value of Anecdote
     *
     * @return mixed
     */
    public function getAnecdote()
    {
        return $this->anecdote;
    }

    /**
     * Set the value of Anecdote
     *
     * @param mixed anecdote
     *
     * @return self
     */
    public function setAnecdote($anecdote)
    {
        $this->anecdote = $anecdote;

        return $this;
    }

    /**
     * Get the value of Wiki
     *
     * @return mixed
     */
    public function getWiki()
    {
        return $this->wiki;
    }

    /**
     * Set the value of Wiki
     *
     * @param mixed wiki
     *
     * @return self
     */
    public function setWiki($wiki)
    {
        $this->wiki = $wiki;

        return $this;
    }

}
