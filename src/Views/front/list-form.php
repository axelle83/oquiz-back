<?php $this->layout('layout'); ?>

<section class="container-fluid">

<p id="quizTitle"><?=$quiz->getTitle()?> <span class="bg-secondary rounded text-white p-1 m-2 small"><?=count($questions)?> questions</span></p>
<p id="quizDescription"><?=$quiz->getDescription()?></p>
<p>by <?=$quiz->getAuthor()?></p>

<div class="alert alert-info w-100" id="gameMsg">
    <?php if($_POST): ?>
        <?php if ($win == 10) :?>
            Gagné !<br>
            <a href="<?=$router->generate('home')?>">
                <input type="button" class="btn btn-primary" value="Jouer à un autre quiz">
            </a>
        <?php else :?>
            Votre score : <?=$win?> / <?=count($questions)?>
            <br>Rejouer
        <?php endif; ?>
    <?php else : ?>
    Nouveau jeu : répondez au maximum de questions avant de valider !
    <?php endif; ?>
</div>

<form  id="submitQuiz" action="<?=$router->generate('quiz', [ 'id' => $quiz->getId() ])?>" method="post">
    <div class="row m-2">
        <!-- pour chaque question -->
        <?php foreach ($questions as $question): ?>
            <!-- récupère les 4 propositions de réponse et les mélange -->
            <?php $list = [$question->getProp1(),$question->getProp2(),$question->getProp3(),$question->getProp4()]; ?>
            <?php $props = \Oquiz\Controllers\QuizController::shuffle_assoc($list); ?>
            <!-- affichage des éléments de la question -->
            <div class="col-12 col-md-4 p-2 border">
                <!-- recherche si on a joué sur cette question -->
                <?php if( array_key_exists($question->getQuestionId(), $answers))  $answer= $answers[$question->getQuestionId()]; else  $answer=0; ?>
                <!-- affiche la question et le niveau -->
                <p class="border questionTitle answer<?=$answer?>"><?=$question->getQuestion()?><span class="level<?=$question->getLevelId()?> border m-2 p-1 rounded"><?=$question->getLevel()?></span></p>
                <!-- affiche les propositions de réponse sous forme de bouton radio -->
                <?php foreach ($props as $prop): ?>
                    <input type="radio" id="<?=$prop?><?=$question->getQuestionId()?>" value="<?=$prop?>" name="<?=$question->getQuestionId()?>"
                    <?php if ($answer == 1 && $prop == $question->getProp1()) echo 'checked'?>>
                    <label for="<?=$prop?><?=$question->getQuestionId()?>"><?=$prop?></label>
                    <br>
                <?php endforeach; ?>
                <!-- affiche l'anecdote et le wiki si on a joué sur cette question -->
                <?php if( array_key_exists($question->getQuestionId(), $answers)) : ?>
                <p class="border-top"><?=$question->getAnecdote()?></p>
                <a href="https://fr.wikipedia.org/wiki/<?=$question->getWiki()?>" target="_blank">
                    <p class="border-top text-primary">Indice wikipedia</p>
                </a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if($win < 10) : ?>
        <input class="w-100 bg-primary text-white p-1 border-primary rounded" type="submit"
        value="<?php if ($_POST) : ?> Rejouer <?php else : ?> OK<?php endif; ?>"
        data-id="<?=$quiz->getId()?>">
    <?php endif; ?>
</form>
</section>
