<?php $this->layout('layout'); ?>

<div class="container">
    <div class="row">
        <div class="area col-md-6 m-auto">
            <h1>Connexion</h1>
               <!-- messages d'erreur PHP -->
              <?php if (count($errors) > 0): ?>
                    <?php foreach($errors as $error): ?>
                        <div class="alert alert-danger"><?=$error?></div>
                    <?php endforeach; ?>
              <?php endif; ?>
            <form id="signin-form" action="<?=$router->generate('connect')?>" method="post">
                <div class="form-group">
                    <label for="email">Ton email</label>
                    <input
                        id="email"
                        type="text"
                        name="email"
                        class="form-control"
                        placeholder="clark.kent@superman.fr"
                        value=""
                    >
                </div>
                <div class="form-group">
                    <label for="password">Ton mot de passe</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="lois"
                        value=""
                    >
                </div>
                <input type="submit" class="btn btn-primary" value="Se connecter">
            </form>
        </div>
    </div>
</div>
