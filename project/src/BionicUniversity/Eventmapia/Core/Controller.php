<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

use BionicUniversity\Eventmapia\Models;
use BionicUniversity\Eventmapia\Core;
use BionicUniversity\Eventmapia\Core\Auth\Auth;

/**
 * Controller Frontend
 * 
 */
class Controller
{
    /** @var Request */
    protected $request;
    
    /** @var Model */
    protected $model;
    
    /** @var View */
    public $view;

    /** @var string $modelPath */
    protected $modelPath;

    /** @var Auth */
    protected $auth;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();

        $this->auth = new Auth();
        $this->session = new Session();
    }
    
    /**
     * Load model
     *
     * @param string $model Name of require model
     * @return object
     */
	public function loadModel($model)
	{    
        $className = 'BionicUniversity\\Eventmapia\\Models' . DIRECTORY_SEPARATOR . ucfirst(strtolower($model));
        $path = $this->getModelPath() . DIRECTORY_SEPARATOR . ucfirst(strtolower($model)) . '.php';

        if (file_exists($path)) {
            require_once $path;
            return new $className;
            // $this->model = new $modelName();
        }
    }

    private function getModelPath()
    {
        return $this->modelPath;
    }

    public function setModelPath($modelPath)
    {
        $this->modelPath = $modelPath;
    }

    public function redirect($path)
    {
        header('Location:' . $path);
    }
}