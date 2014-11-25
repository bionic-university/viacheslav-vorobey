<?php


/** Only for test application */
require '..\src\BionicUniversity\Eventmapia\Core\Application.php';
require '..\src\BionicUniversity\Eventmapia\Core\Config.php';
require '..\src\BionicUniversity\Eventmapia\Core\Controller.php';
require '..\src\BionicUniversity\Eventmapia\Core\View.php';
require '..\src\BionicUniversity\Eventmapia\Core\Request.php';
require '..\src\BionicUniversity\Eventmapia\Core\Model.php';
require '..\src\BionicUniversity\Eventmapia\Core\Db\Database.php';
/** Only for test application */


//require_once dirname(__DIR__) . '/../vendor/autoload.php';
$config = require_once __DIR__ . '/../app/config/config.php';

$app = new BionicUniversity\Eventmapia\Core\Application($config);