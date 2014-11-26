<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

use BionicUniversity\Eventmapia\Core\Db\Database;

/**
 * Model Frontend
 */
class Model
{
    /**
     * @var object $db
     */
    private $db;


    /**
     * Constructor
     */
    public function __construct()
    {
        // Load connection configuration data
        if (!$db = Config::getInstance()->get('db')) {
            throw new \Exception('Configuration is missed!');
        }

        $this->db = new Database($db);
	}

    protected function model($className = __CLASS__)
    {
        return new $className;

        /*
        if (isset(self::$model)) {
            return self::$model;
        } else {
            $model = self::$model = new $className(null);
            return $model;
        }
        */
    }


}