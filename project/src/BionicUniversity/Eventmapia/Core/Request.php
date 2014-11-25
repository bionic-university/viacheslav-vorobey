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
 * Class for the current HTTP request
 */
class Request
{
    /**
     * Check if request has POST method
     * @return boolean
     */
    protected function isPost()
    {
        return !empty($_SERVER['REQUEST_METHOD']) && 
            strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
    }
    
    /**
     * Check if request has GET method
     * @return boolean
     */
    protected function isGet()
    {
        return !empty($_SERVER['REQUEST_METHOD']) && 
            strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
    }
    
    /**
     * Check if request is an AJAX request
     * @return boolean
     */
    protected function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }
}