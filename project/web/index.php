<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';
$config = require_once dirname(__DIR__) . '/app/config/config.php';

(new BionicUniversity\Eventmapia\Core\Application($config))->run();
