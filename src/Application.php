<?php

namespace Oquiz;

class Application {

    public function __construct() {

        // on récupère les données de config
        $config = parse_ini_file(__DIR__.'/../config.ini');
        \Oquiz\Utils\Database::setConfig($config);

        // on crée le router
        $this->router = new \AltoRouter();

        // on récupère la partie de l'URL fixe grâce à $_SERVER['BASE_URI']
        $basePath = isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : '';

        // on renseigne la partie de l'URL fixe
        $this->router->setBasePath($basePath);

        // on lance le mapping
        $this->mapping();
    }

    private function mapping() {

        // mapping de toutes les URL
        // page d'accueil
        $this->router->map('GET', '/', ['MainController', 'indexAction'], 'home');
        // page d'un quiz (consulter ou jouer)
        $this->router->map('GET|POST', '/quiz/[i:id]', ['QuizController', 'read'], 'quiz');
        // inscription
        $this->router->map('GET|POST', '/signup', ['UserController', 'create'], 'subscribe');
        // connection
        $this->router->map('GET|POST', '/signin', ['UserController', 'connect'], 'connect');
        // déconnection
        $this->router->map('GET', '/signout', ['UserController', 'disconnect'], 'disconnect');
        // profil user (accesible seulement à l'user connecté)
        $this->router->map('GET', '/compte/[i:id]', ['QuizController', 'account'], 'account');
        // création de quiz (accesible seulement à l'user connecté)
        $this->router->map('GET|POST', '/create/[i:id]', ['QuizController', 'create'], 'create_quiz');
        // création de question (accesible seulement à l'user connecté)
        $this->router->map('GET|POST', '/create/question/[i:id]', ['QuestionController', 'create'], 'create_question');
    }

    public function run() {

        // récupère les données de Altorouter
        $match = $this->router->match();

        if (!$match) {
          // on a pas trouvé la route, on redirige vers la méthode correspondant à l'erreur 404
          $controllerName = "\Oquiz\Controllers\MainController";
          $methodName = 'error404';
        } else {
          //on regarde quel contrôleur et quelle méthode utliser
          $controllerName = "\Oquiz\Controllers\\" . $match['target'][0];
          $methodName = $match['target'][1];
        }

        // on exécute la bonne  méthode
        $controller = new $controllerName( $this->router );
        $controller->$methodName( $match['params'] );
    }
}
