<?php
$namespaces = [
    'app',
    'app/controller',
    'app/lib',
    'app/model',
];

foreach ($namespaces as $namespace) {
    $files = glob($namespace.'/*.php');
    foreach ($files as $file) {
        require_once $file;
    }
}
