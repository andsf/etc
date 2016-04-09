<?php
$targetDirs = [
    'app',
    'app/controller',
    'app/lib',
    'app/sql',
    'app/sql/Dao'
];

foreach ($targetDirs as $dir) {
    $files = glob($dir.'/*.php');
    foreach ($files as $file) {
        require_once $file;
    }
}
