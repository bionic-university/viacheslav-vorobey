<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

use BionicUniversity\Eventmapia\Models;

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

    /**
     * Constructor
     */
    function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
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

            echo '<br>'; print_r($path);
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
}