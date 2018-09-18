<?php $this->layout('layout') ?>

<div class="container">

    <div class="row">
        <div class="col-md-8 m-auto">
          <h1>Inscription</h1>
           <!-- messages d'erreur PHP -->
          <?php if (count($errors) > 0): ?>
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endforeach; ?>
          <?php endif; ?>
          <!-- formulaire de création de compte -->
            <form id="subscribe" class="" action="<?=$router->generate('subscribe')?>" method="post">
                <div class="form-group">
                    <label for="firstname">Ton prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Clark"
                    value="<?=($_POST['firstname'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="lastname">Ton nom</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Kent"
                    value="<?=($_POST['lastname'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="email">Ton email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="clark@superman.fr"
                    value="<?=($_POST['email'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="password">Ton mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="lois">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Resaisis ton mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="le même qu'au dessus">
                </div>
                <button type="submit" class="btn btn-primary">Créer le compte</button>
            </form>
        </div>
    </div>

</div>
