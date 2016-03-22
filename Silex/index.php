<?php
require_once './vendor/autoload.php';

#start silex application.
$app = new Silex\Application();

#require route.php.
require_once './app/router.php';

#run
$app->run();
