<?php
$namespaces = [
    'app',
    'app/controller',
    'app/lib',
    // 'app/lib/package',
    'app/model',
];
// $exclusionFiles = [
//     'Dao.php'
// ];

foreach ($namespaces as $namespace) {
    $files = glob($namespace.'/*.php');
    // foreach ($exclusionFiles as $exclusionFile) {
    //     if ($targetKey = array_search($exclusionFile, $files) !== false) {
    //         unset($files[$targetKey]);
    //     }
    // }
    foreach ($files as $file) {
        // require_once $namespace.'/'.$file;
        require_once $file;
    }
}
