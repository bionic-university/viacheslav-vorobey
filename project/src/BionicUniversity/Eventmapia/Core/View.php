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
 * View Frontend
 */
class View 
{
    /**
     * @var string $layout Template name
     */
    public $layout = 'layout.php'; 
    
    /**
     * Render 
     * @param string $name
     * @param mixed $data
     */
    function render($name, $data = null)
    {
       require_once 'src/views/' . $this->layout;
    } 
    
    /**
     * Render 
     * @throws \Exception
     * @return string
     */
    function assign()
    {
       ob_start();
        try {
            if (!file_exists($this->path . '/' . $this->template) or !is_file($this->path . '/' . $this->template)) {
                throw new \Exception("Template '{$this->template}' not found");
            }
            extract($this->container);
            require $this->path . '/' . $this->template;
        } catch (\Exception $e) {
            ob_end_clean();
            return '';
        }
        return ob_get_clean();
    }	
}