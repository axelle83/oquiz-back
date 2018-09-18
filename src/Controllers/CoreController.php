<?php

namespace Oquiz\Controllers;

// use League\Plates\Engine as PlatesEngine;

abstract class CoreController {

    protected $templates;
    protected $router;
    protected $user;

    public function __construct($router) {

        // on enregistre le router pour pouvoir l'utiliser dans une autre méthode
        $this->router = $router;

        // on enregistre l'utilisateur
        $this->user = \Oquiz\Models\UserModel::getUser();

        //on instancie le moteur de templates
        $this->templates = new \League\Plates\Engine(__DIR__ . '/../Views/');

        //oOn ajoute les données disponibles dans tous les templates
        $this->templates->addData([
            'baseUrl' => (isset($_SERVER['BASE_URI']) ? $_SERVER['BASE_URI'] : ''),
            'router' => $this->router,
            'user' => $this->user
        ]);
    }
}
