<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core/Db
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */

namespace BionicUniversity\Eventmapia\Core\Db;

/**
 * Database Frontend
 *
 */
class Database extends \PDO
{
    /**
     * PDO instance
     * @var \PDO $handler
     */
    protected $handler;

    /**
     * Constructor
     * Initialize a PDO connection
     *
     * @param array $db An associative array with DB settings
     */
    public function __construct($db)
    {
        $persistent = isset($db['persistent']) ? $db['persistent'] : false;
        parent::__construct("{$db['type']}:host={$db['host']};dbname={$db['name']}", $db['user'], $db['pass'], array(\PDO::ATTR_PERSISTENT => $persistent));
    }
    
}
