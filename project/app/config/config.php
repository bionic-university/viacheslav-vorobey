<?php

return [
    /** Common configuration */
    'baseUrl' => '',
    'basePath' => dirname(__FILE__),
    'defaultController' => 'index',
    'defaultAction' => 'index',
    
    /** Database configuration */
    'db' => [
        'type' => 'mysql',
        'host' => 'localhost',
        'name' => 'eventmapia',
        'user' => 'root',
        'pass' => '',
        //'persistent' => true
    ],
    
    /** Debug configuration */
    'debug' => [],
];