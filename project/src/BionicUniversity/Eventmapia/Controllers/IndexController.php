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
        //echo 'Hello from IndexController :: indexAction';

        $events = $this->loadModel('events');

        $this->view->render('index/index', [
            'events' => $events
        ]);
    }

    /**
     *
     *
     */
    public function addAction()
    {
        echo 'Hello from IndexController :: addAction';
        $this->view->render('index/index');
    }

    /**
     *
     *
     */
    public function viewAction($id = null)
    {

    }
}