<header class="container">
    <div class="navbar m-0 p-0 fixed-top">
        <div id="title" class="text-primary col-2 p-3">
            O'Quiz
        </div>
        <?php if ($user): ?>
        <div class="col-2 p-3 text-primary">
                Bonjour <?=$user->firstname ?>
        </div>
        <?php else : ?>
        <div class="col-4 p-3">
        </div>
        <?php endif; ?>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('home')?>">
                <i class="fas fa-home"></i>
                Accueil
            </a>
        </div>
        <?php if ($user): ?>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('account', ['id' =>$user->id ])?>">
                <i class="fas fa-user"></i>
                Mon profil
            </a>
        </div>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('create_quiz', ['id' =>$user->id ])?>">
                <i class="fas fa-sign-in-alt"></i>
                Créer un quiz
            </a>
        </div>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('disconnect')?>">
                <i class="fas fa-sign-in-alt"></i>
                Déconnexion
            </a>
        </div>
        <?php else : ?>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('subscribe')?>">
                <i class="far fa-edit"></i>
                Inscription
            </a>
        </div>
        <div class="col-2 p-3">
            <a href="<?=$router->generate('connect')?>">
                <i class="fas fa-sign-in-alt"></i>
                Connexion
            </a>

        </div>
        <?php endif; ?>
    </div>
</header>
