<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;

/**
 *
 *
 */
class IndexController extends Controller
{
    /**
     *
     *
     */
    public function indexAction()
    {
        echo 'Hello from IndexController :: indexAction';

        if ($this->loadModel('user')) {
            echo "<br> Model is loaded!";
        }

    }

    /**
     *
     *
     */
    public function addAction()
    {
        echo 'Hello from IndexController :: addAction';
    }

    /**
     *
     *
     */
    public function viewAction($id = null)
    {

    }
}