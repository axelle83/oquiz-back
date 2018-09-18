<?php $this->layout('layout') ?>

<div class="container">

    <div class="row">
        <div class="col-md-8 m-auto">
          <h1>Créer une nouvelle question</h1>
           <!-- messages d'erreur PHP -->
          <?php if (count($errors) > 0): ?>
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endforeach; ?>
          <?php endif; ?>
          <h3>Nom du quiz : <?=$quiz->getTitle()?></h3>
          <!-- formulaire de création d'une question -->
            <form id="newQuiz" class="" action="<?=$router->generate('create_question', ['id' =>$quiz->getId() ])?>" method="post">
                <div class="form-group">
                    <label for="question">Question</label>
                    <input type="text" class="form-control" name="question" id="question" placeholder="Comment s'appelle..."
                    value="<?=($_POST['question'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="id_level">Niveau (1=débutant / 2=confirmé / 3=expert)</label>
                    <input type="text" class="form-control" name="id_level" id="id_level" placeholder="1"
                    value="<?=($_POST['id_level'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="prop1">Proposition 1 (la bonne réponse)</label>
                    <input type="text" class="form-control" name="prop1" id="prop1" placeholder="un cochon"
                    value="<?=($_POST['prop1'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="prop2">Proposition 2</label>
                    <input type="text" class="form-control" name="prop2" id="prop2" placeholder="un mouton"
                    value="<?=($_POST['prop2'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="prop3">Proposition 3</label>
                    <input type="text" class="form-control" name="prop3" id="prop3" placeholder="un chien"
                    value="<?=($_POST['prop3'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="prop4">Proposition 4</label>
                    <input type="text" class="form-control" name="prop4" id="prop4" placeholder="une chèvre"
                    value="<?=($_POST['prop4'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="anecdote">Anecdote</label>
                    <input type="text" class="form-control" name="anecdote" id="anecdote" placeholder="A l'occasion de ..."
                    value="<?=($_POST['anecdote'] ?? '')?>">
                </div>
                <div class="form-group">
                    <label for="wiki">Wiki</label>
                    <input type="text" class="form-control" name="wiki" id="wiki" placeholder="Bon pour le moral, un peu mois pour le foie"
                    value="<?=($_POST['wiki'] ?? '')?>">
                </div>
                <button type="submit" class="btn btn-primary">Créer la question</button>
            </form>
        </div>
    </div>

</div>
