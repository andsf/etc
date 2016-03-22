<?php

$app->get('/', 'Silex\\Controllers\\HelloController::index');
//$app->get('/', function() use ($app) {
//    return $app->redirect('/hello');
//});

