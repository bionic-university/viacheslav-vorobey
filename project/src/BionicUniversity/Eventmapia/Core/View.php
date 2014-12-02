<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

/**
 * View Frontend
 */
class View 
{
    /** @var string $layout Template name */
    public $layout = 'layout.php';

    /** @var string $viewPath Path to view files */
    public $viewPath;
    
    /**
     * Render
     * @param string $name
     * @param mixed $data
     * @throws \Exception
     */
    function render($name, $data = null)
    {
        if (!file_exists($this->viewPath . DIRECTORY_SEPARATOR . $this->layout) or
            !is_file($this->viewPath . DIRECTORY_SEPARATOR . $this->layout)) {
            throw new \Exception("Template '{$this->layout}' not found");
        }

        require_once $this->viewPath . DIRECTORY_SEPARATOR . $this->layout;
    } 
    
    /**
     * New render
     * Get the evaluated contents of the view
     *
     * @param string $path
     * @param array $data
     * @throws \Exception
     * @return string
     */
    function get($path, array $data = [])
    {
        ob_start();
        extract($data);

        try {
            if (!file_exists($this->viewPath . DIRECTORY_SEPARATOR . $this->layout) or
                !is_file($this->viewPath . DIRECTORY_SEPARATOR . $this->layout)) {
                throw new \Exception("Template '{$this->layout}' not found");
            }
            require $this->viewPath . DIRECTORY_SEPARATOR . $this->layout;
        } catch (\Exception $e) {
            ob_end_clean();
            return '';
        }

        return ob_get_clean();
    }

    /**
     * Set path to view files. Called from the Application
     * @param string $viewPath
     */
    public function setViewPath($viewPath)
    {
        $this->viewPath = $viewPath;
    }
}