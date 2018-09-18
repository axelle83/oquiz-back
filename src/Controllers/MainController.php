<?php

namespace Oquiz\Controllers;

class MainController extends CoreController {

    // affiche la page d'accueil avec la liste des quiz
    public function indexAction() {

        // on récupère la liste des quizz
        $results = \Oquiz\Models\QuizModel::findAll();

        echo $this->templates->render('main/home', [
            'quizzes' =>$results]);
    }

    // affiche la page d'erreur 404 s'il n'y a pas de route trouvée
    public function error404() {
        echo $this->templates->render('main/404');
    }


}
