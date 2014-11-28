<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

/**
 * Class for the current HTTP request
 */
class Request
{
    /**
     * Check if request has POST method
     * @return boolean
     */
    public function isPost()
    {
        return !empty($_SERVER['REQUEST_METHOD']) && 
            strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }
    
    /**
     * Check if request has GET method
     * @return boolean
     */
    public function isGet()
    {
        return !empty($_SERVER['REQUEST_METHOD']) && 
            strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
    }
    
    /**
     * Check if request is an AJAX request
     * @return boolean
     */
    public function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     *
     * @param string|null $param
     * @return array|mixed
     */
    public function getParam($param = null)
    {
        if (!is_null($param)) {
            if (isset($_POST[$param])) {
                return $_POST[$param];
            } else {
                return null;
            }
        }

        return (array) $_POST;
    }
}