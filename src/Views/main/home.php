<?php $this->layout('layout'); ?>

<section class="container-fluid">
    <?php if ($_SERVER['REQUEST_URI'] == $baseUrl.'/') :?>
        <!-- affiche le message d'accueil si on est sur la route home -->
        <h1 class=" font-weight-bold">Bienvenue sur O'Quiz</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <?php else : ?>
        <!-- sinon on est sur la page "mon compte" -->
        <h1 class=" font-weight-bold">Mes quiz</h1>
    <?php endif; ?>
    <div class="row m-2">
        <?php foreach ($quizzes as $quizz): ?>
            <!-- Affiche pour chaque quiz titre + description + auteur -->
            <div class="col-12 col-md-4 p-2">
                <a class="quiz-title font-weight-bold text-primary" href="<?=$router->generate('quiz',[ 'id' => $quizz->getId() ])?>"><?=$quizz->getTitle()?></a>
                <p class="font-weight-bold"><?=$quizz->getDescription()?></p>
                <p>by <?=$quizz->getAuthor()?></p>
                <!-- si on est sur la apge mon compte affiche le lien pour créer une question -->
                <?php if ($_SERVER['REQUEST_URI'] !== $baseUrl.'/') :?>
                    <a href="<?=$router->generate('create_question', ['id' =>$quizz->getId() ])?>">
                        <i class="far fa-edit"></i>
                        Ajouter une question
                    </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
