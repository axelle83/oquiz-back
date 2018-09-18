<?php $this->layout('layout') ?>

<section class="container-fluid">

<p id="quizTitle"><?=$quiz->getTitle()?> <span class="bg-secondary rounded text-white p-1 m-2 small"><?=count($questions)?> questions</span></p>
<p id="quizDescription"><?=$quiz->getDescription()?></p>
<p>by <?=$quiz->getAuthor()?></p>

<div class="row m-2">
    <?php foreach ($questions as $question): ?>
        <!-- récupère les 4 propositions de réponse et les mélange -->
        <?php $props = [$question->getProp1(),$question->getProp2(),$question->getProp3(),$question->getProp4()];
        shuffle($props); ?>
        <!-- Affiche pour chaque question : questions + props + niveau -->
        <div class="col-12 col-md-4 p-2 border">
            <p class="border questionTitle"><?=$question->getQuestion()?><span class="level<?=$question->getId()?> border m-2 p-1 rounded"><?=$question->getLevel()?></span></p>
            <ol>
                <?php foreach ($props as $prop): ?>
                <li><?=$prop?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endforeach; ?>
</div>
</section>
