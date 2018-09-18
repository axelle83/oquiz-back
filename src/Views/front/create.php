<?php $this->layout('layout') ?>

<div class="container">

    <div class="row">
        <div class="col-md-8 m-auto">
          <h1>Créer un nouveau quiz</h1>
           <!-- messages d'erreur PHP -->
          <?php if (count($errors) > 0): ?>
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endforeach; ?>
          <?php endif; ?>

          <!-- formulaire de création de quiz -->
            <form id="newQuiz" class="" action="<?=$router->generate('create_quiz', ['id' =>$user->id ])?>" method="post">
                <div class="form-group">
                    <label for="title">Titre du quiz</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Le chocolat"
                    value="<?=($_POST['title'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="description">Petite description du quiz</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Bon pour le moral, un peu mois pour le foie"
                    value="<?=($_POST['description'] ?? '')?>">
                </div>
                <button type="submit" class="btn btn-primary">Créer le quiz</button>
            </form>
        </div>
    </div>

</div>
