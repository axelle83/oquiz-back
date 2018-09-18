<?php

namespace Oquiz\Controllers;

class QuizController extends CoreController {

    // affiche les questions d'un quiz
    public function read($params) {

        // on initialise les variables dont on aura besoin
        $answers = [];
        $win = 0;
        // on récupère l'id du quiz à afficher
        $id = $params['id'];
        // on récupère le quiz
        $quiz = \Oquiz\Models\QuizModel::findById($id);
        // on récupère les questions correspondantes
        $questions = \Oquiz\Models\QuestionModel::findAllByQuiz($id);

        // on regarde si le formulaire a été validé
        if (!empty($_POST)) {
            // si oui on vérfie pour chaque question si la réponse est correcte
            foreach($_POST as $question=>$response) {
                $answer = \Oquiz\Models\QuestionModel::findAnswer($question);
                // je pense qu'il serai plus judicieux de traiter tes trois états ici pour te faciliter la vie dans ton formulaire  : Vrai , faux , Pas rempli
                if ($response == $answer->getProp1()) {
                    // la réponse est correcte
                    $answers[$question] = 1;
                    $win++;
                } else {
                    $answers[$question] = 2; // donc si elle est pas correcte elle prend 2 ? ;)
                };
            }
        }

        // on transmet les données du quiz au template
        if ($this->user) {
            // si l'utilisateur est connecté : template de jeu
            echo $this->templates->render('front/list-form', [
                'quiz' => $quiz,
                'questions' => $questions,
                'win'=> $win,
                'answers'=> $answers
            ]);
        } else {
            // s'il n'est pas connecté : template de liste de questions
            echo $this->templates->render('front/quiz', [
                'quiz' => $quiz,
                'questions' => $questions
            ]);
        }
    }

    // affiche la liste des quiz créés par l'utilisateur connecté
    public function account($params) {
        // on récupère l'id de l'utilisateur
        $id = $params['id'];
        // on récupère la liste des quizz
        $results = \Oquiz\Models\QuizModel::findByAuthor($id);

        echo $this->templates->render('main/home', [
            'quizzes' =>$results]);
    }

    // permet de créer un quiz
    public function create($params) {

        $id = $params['id'];
        $errors = [];

        // on regarde si le formulaire a été validé
        if (!empty($_POST)) {
            // si oui on vérfie les données du formulaire
            $errors = \Oquiz\Models\QuizModel::checkData($_POST);
            // s'il n'y a pas d'erreurs on crée le quiz
            if (count($errors) === 0) {

                $quiz = new \Oquiz\Models\QuizModel();
                $quiz->setTitle($_POST['title']);
                $quiz->setDescription($_POST['description']);
                $quiz->setIdAuthor($id);
                $quiz->save();
                // on redirige l'utilisateur vers la page de ses quiz
                header('Location: ' . $this->router->generate('account', ['id' =>$id ]));
                exit();
            }
        }
        // si y a des erreurs on revient sur le formulaire de création de quiz en spécifiant les erreurs
        echo $this->templates->render('front/create', ['errors' => $errors]);
    }

    // permet de mélanger les propositions de réponse pour chaque question
    public static function shuffle_assoc($list) {
      if (!is_array($list)) return $list;

      $keys = array_keys($list);
      shuffle($keys);
      $props = array();
      foreach ($keys as $key)
        $props[$key] = $list[$key];

      return $props;
  }
}
