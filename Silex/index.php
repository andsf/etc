<?php
require_once './vendor/autoload.php';

#start silex application.
$app = new Silex\Application();

#set service provider
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => './app/view', 
));

#require route.php.
require_once './app/routes.php';

#run
$app->run();
