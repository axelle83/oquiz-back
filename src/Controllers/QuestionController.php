<?php

namespace Oquiz\Controllers;

class QuestionController extends CoreController {

    // permet de créer une question
    public function create($params) {

        $errors = [];
        // on récupère le quiz
        $id = $params['id'];
        $quiz = \Oquiz\Models\QuizModel::findById($id);
        // on regarde si le formulaire a été validé
        if (!empty($_POST)) {
            // si oui on vérfie les données du formulaire
            $errors = \Oquiz\Models\QuestionModel::checkData($_POST);
            if (count($errors) === 0) {
                // s'il n'y a pas d'erreurs on crée la question
                $question = new \Oquiz\Models\QuestionModel();
                $question->setQuestion($_POST['question']);
                $question->setProp1($_POST['prop1']);
                $question->setProp2($_POST['prop2']);
                $question->setProp3($_POST['prop3']);
                $question->setProp4($_POST['prop4']);
                $question->setIdLevel($_POST['id_level']);
                $question->setAnecdote($_POST['anecdote']);
                $question->setWiki($_POST['wiki']);
                $question->setIdQuiz($quiz->getId());
                $question->save();
                // on redirige l'utilisateur vers la page du quiz
                header('Location: ' . $this->router->generate('quiz', ['id' =>$quiz->getId() ]));
                exit();
            }
        }
        // si y a des erreurs on revient sur le formulaire de création de quiz en spécifiant les erreurs
        echo $this->templates->render('front/create-question', [
            'errors' => $errors,
            'quiz' => $quiz
        ]);
    }
}
