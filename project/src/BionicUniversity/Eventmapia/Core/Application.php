<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/
 */
 
namespace BionicUniversity\Eventmapia\Core;

use BionicUniversity\Eventmapia\Controllers;

/**
 * Class Application
 */
class Application
{
    /** @var string $defaultControllerName */
    private $defaultControllerName = 'IndexController';

    /** @var string $defaultActionName */
    private $defaultActionName = 'indexAction';

    /** @var string $controllerName */
    private $controllerName;
    
    /** @var string $actionName */
    private $actionName;

    /** @var array $params */    
    private $params = [];

    /** @var string $basePath The root directory of the application */
    private $basePath;

    /** @var string $controllerPath Path to controllers directory */
    public $controllerPath;

    /** @var string $modelPath Path to models directory */
    public $modelPath;

    /** @var string $viewPath Path to views directory */
    public $viewPath;

    public $controllerNamespace = '\\BionicUniversity\\Eventmapia\\Controllers';
  
    /**
     * Constructor
     * @param array $config The application configuration
     */
    public function __construct($config = [])
    {
        // Load configuration data to config array
        Config::getInstance()->init($config);
        
        // Pre-initializes the application
        $this->preInit();

        $url = $this->getUrl();

        $controllerFile = $this->getControllerRealPath($url[0]);
        if (file_exists($controllerFile)) {
            unset($url[0]);
            require $controllerFile;
        } else {
            $this->controllerName = $this->getDefaultController();
            $this->redirect();
        }

        $controllerName = 'BionicUniversity\Eventmapia\Controllers\\' . $this->controllerName;
        $this->controllerName = new $controllerName;

        // Set path to models directory
        $this->controllerName->setModelPath($this->getModelPath());

        $this->actionName = $this->getDefaultAction();
        if (isset($url[1])) {
            if (method_exists($this->controllerName, strtolower($url[1]) . 'Action')) {
                $this->actionName = strtolower($url[1]) . 'Action';
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controllerName, $this->actionName], $this->params);
    }

    /**
     * Pre-initializes the application
     * @throws \Exception
     */
    public function preInit()
    {
        // Get all configuration data
        $config = Config::getInstance()->get();

        if (!$config || !isset($config['basePath']) || empty($config['basePath'])) {
            throw new \Exception('Configuration is missed. The "basePath" is required.');
        } else {
            $this->setBasePath($config['basePath']);
            unset($config['basePath']);
        }

        if (isset($config['defaultController']) && !empty($config['defaultController'])) {
            $this->setDefaultController($config['defaultController']);
            unset($config['defaultController']);
        }

        if (isset($config['defaultAction']) && !empty($config['defaultAction'])) {
            $this->setDefaultAction($config['defaultAction']);
            unset($config['defaultAction']);
        }
    }

    /**
     * @param string $nameFromUri
     * @return string
     */
    private function getControllerRealPath($nameFromUri)
    {
        $this->controllerName = /*$this->controllerNamespace . DIRECTORY_SEPARATOR . */ucfirst(strtolower($nameFromUri)) . 'Controller';
        return $this->getControllerPath() . DIRECTORY_SEPARATOR . $this->controllerName . '.php';
    }
    /**
     * Set the root directory of the application
     * @param string $path The root directory of the application
     * @throws \Exception
     */
    private function setBasePath($path)
    {
        $class = new \ReflectionClass($this);
        $basePath = realpath(dirname($class->getFileName()) . DIRECTORY_SEPARATOR . '..');

        if ($basePath !== false && is_dir($basePath)) {
            $this->basePath = $basePath;
        } else {
            throw new \Exception('The directory does not exist:\n' . $basePath);
        }
    }

    /**
     * Return the root directory of the application
     * @return string The root directory of the application
     */
    public function getBasePath()
    {
        /*
        if ($this->basePath === null) {
            $class = new \ReflectionClass($this);
            $this->basePath = dirname($class->getFileName());
        }
        */
        return $this->basePath;
    }

    /**
     * Set the default controller from config
     * @param string $controllerName
     */
    private function setDefaultController($controllerName)
    {
        $this->defaultControllerName = ucfirst(strtolower($controllerName)) . 'Controller';
    }

    /**
     * Return default controller name
     * @return string
     */
    private function getDefaultController()
    {
        return $this->defaultControllerName;
    }

    /**
     * Set the default action from config
     * @param string $actionName
     */
    private function setDefaultAction($actionName)
    {
        $this->defaultActionName = strtolower($actionName) . 'Action';
    }

    /**
     * Return default action name
     * @return string
     */
    private function getDefaultAction()
    {
        return $this->defaultActionName;
    }

    /**
     * Return the directory for the controllers files. Default is "[basePath]/Controllers"
     * @return string The root directory of controllers files
     */
    public function getControllerPath()
    {
        if ($this->viewPath !== null) {
            return $this->viewPath;
        } else {
            return $this->viewPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'Controllers';
        }
    }

    /**
     * Return the directory for the view files. Default is "[basePath]/Views"
     * @return string The root directory of view files
     */
    public function getViewPath()
    {
        if ($this->viewPath !== null) {
            return $this->viewPath;
        } else {
            return $this->viewPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'Views';
        }
    }

    /**
     * Return the directory for the model files. Default is "[basePath]/Models"
     * @return string The root directory of models files
     */
    public function getModelPath()
    {
        if ($this->modelPath !== null) {
            return $this->modelPath;
        } else {
            return $this->modelPath = $this->getBasePath() . DIRECTORY_SEPARATOR . 'Models';
        }
    }
     
    /**
     * Return exploded URL
     * @return array $url
     */    
    private function getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }

    /**
     * Redirect
     * @param int $code
     */
    private function redirect($code = null)
    {
        if ($code !== null) {
            
        } else {
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/web/index';
            header('Location: ' . $host);
        }
    }
}