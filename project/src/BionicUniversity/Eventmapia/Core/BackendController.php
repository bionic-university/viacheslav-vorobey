<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Core;

use BionicUniversity\Eventmapia\Core\Controller;

/**
 * Backend Controller
 */
class BackendController extends Controller
{
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->view->setLayout('dashboard');
    }

    /**
     * Redirect
     */
    public function redirectTo($path)
    {
        header('Location: /web/dashboard/' . $path);
    }

    public function init() 
    {
        
    }
}