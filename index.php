<?php

// on démarre les sessions
session_start();

// on inclut l'autoload de composer pour inclure automatiquement toutes les classes du projet
require(__DIR__ . '/vendor/autoload.php');

// on crée l'application
$application = new Oquiz\Application();
// on la démarre
$application->run();
