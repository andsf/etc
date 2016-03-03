<?php

require_once 'dispatcher.php';
require_once 'autoLoader.php';

$dispatch = new dispatcher();

$dispatch->dispatch($_SERVER['REQUEST_URI']);
