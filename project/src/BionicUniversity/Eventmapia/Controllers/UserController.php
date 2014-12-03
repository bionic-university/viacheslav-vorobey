<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;

/**
 * UserController
 */
class UserController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        
    }

    /**
     * Cabinet action
     */
    public function cabinetAction()
    {
        $user = $this->loadModel('user');

        $this->view->render('user/cabinet', [
            'user' => $user
        ]);
    }

    /**
     * Edit action
     */
    public function editAction($id)
    {

    }

    /**
     * View action
     */
    public function viewAction($id)
    {
        
    }
}