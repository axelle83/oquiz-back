<?php

namespace Oquiz\Controllers;

class UserController extends CoreController {

    // permet de créer un compte
    public function create($params) {

        $errors = [];

        // on regarde si le formulaire a été validé
        if (!empty($_POST)) {
            // si oui on vérfie les données du formulaire
            $errors = \Oquiz\Models\UserModel::checkData($_POST);
            // s'il n'y a pas d'erreurs on crée le compte
            if (count($errors) === 0) {
                $user = new \Oquiz\Models\UserModel();
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                $user->save();
                // on redirige l'utilisateur vers la page de connexion
                header('Location: ' . $this->router->generate('connect'));
                exit();
            }
        }
        // si y a des erreurs on revient sur le formulaire d'inscription en spécifiant les erreurs
        echo $this->templates->render('user/create', ['errors' => $errors]);
    }

    // permet de se connecter
    public function connect() {
        $errors = [];
        if(!empty($_POST)) {
            // on vérifie que le compte existe bien
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = \Oquiz\Models\UserModel::checkAccount($email, $password);

            if (!$user) {
                // pas correct
                $errors[] = 'Le compte n\'existe pas';
            } else {
                // on connecte l'utilisateur et on redirige vers la home
                \Oquiz\Models\UserModel::connect($user);
                header('Location: ' . $this->router->generate('home'));
                exit();
            }
        };
        // on affiche les erreurs sur la page d'inscription
        echo $this->templates->render('user/login', ['errors' =>$errors]);
    }

    // permet de se déconnecter
    public function disconnect() {
        \Oquiz\Models\UserModel::disconnect();
        header('Location: '. $this->router->generate('home'));
    }
}
