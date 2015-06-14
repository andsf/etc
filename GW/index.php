<?php

require_once 'dispatcher.php';

$dispatch = new dispatcher();

$dispatch->Dispatch($_SERVER['REQUEST_URI']);
