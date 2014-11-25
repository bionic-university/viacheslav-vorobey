<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use BionicUniversity\Eventmapia\Models\User;

/**
 * UserController
 *
 */
class UserController extends Controller
{
    /**
     *
     *
     */
    public function indexAction()
    {
        
    }

    /**
     *
     *
     */
    public function addAction()
    {
       if ($this->request->isPost()) {
            // do something
        } else {
            throw new ApplicationException('Fail'); 
        }
    }

    /**
     *
     *
     */
    public function editAction($id)
    {
       
    }
   

    /**
     *
     *
     */
    public function viewAction($id)
    {
        
    }
    
    /**
     *
     *
     */
    public function deleteAction($id)
    {
        if ($this->request->isPost()) {
            $this->model()->delete($id);
            $this->flashMessager->add('User was successfuly removed!')
        } else {
            throw new ApplicationException('Fail'); 
        }
    }
}