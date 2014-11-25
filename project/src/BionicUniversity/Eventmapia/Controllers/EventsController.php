<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use BionicUniversity\Eventmapia\Models\Events;

/**
 * EventsController
 *
 */
class EventsController extends Controller
{
    /**
     *
     *
     */
    public function indexAction()
    {
        echo "Hello from EventsController";
    }

    /**
     *
     *
     */
    public function addAction()
    {
       
    }

    /**
     *
     *
     */
    public function editAction($id)
    {
       
    }


    /**
     * @param int $id
     */
    public function viewAction($id = null)
    {
        echo 'EventsController :: viewAction :: params ' . $id;
    }
    
    /**
     *
     *
     */
    public function deleteAction($id)
    {
        
    }
}