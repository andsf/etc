<?php 
namespace Silex\Controllers;

use Silex\Application;

class HelloController 
{
    public function index(Application $app)
    {
        return $app['twig']->render('hello.twig', ['name' => 'Silex']);
    }
}
