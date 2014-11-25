<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

/**
 * Config static class
 */
class Config
{
    /** @var static $instance Singleton instance */
    public static $instance;
    
    /** @var array $config Configuration data from file */
    private $config = [];
    
    /**
     * Get instance
     * @return static::$instance
     */
    final public static function getInstance()
    {
        if (isset(static::$instance)) {
            return static::$instance;
        } else {
            return static::$instance = new static;
        }
    }

    /**
     * Load configuration file to array
     * @param array file
     * @throws \Exception
     * @return void
     */
    public function init($file)
    {
        if (!is_array($file)) {
            throw new \Exception('Configuration file `'. $file .'` not exist');
        }

        $this->config = $file;
    }
    
    /**
     * If key exist return config data by key, else return full config
     * @param string $key Key of config
     * @throws \Exception
     * @return array
     */
    public function get($key = null)
    {
        if (!$this->config) {
            throw new \Exception('Configuration data is missing');
        }

        if (!is_null($key) && isset($this->config[$key])) {            
            return $this->config[$key];
        } else {
            return $this->config;
        }
    }
    
    private function __construct()
    {

    }
}