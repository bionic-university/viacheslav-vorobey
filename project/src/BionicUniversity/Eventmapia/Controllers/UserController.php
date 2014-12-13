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
        // @TODO:
    }

    /**
     * View action
     * @param int $id
     * @throws \Exception
     */
    public function viewAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $id = abs((int) $id);

        $model = $this->loadModel('user');
        $events = $this->loadModel('events');
        $comments = $this->loadModel('comment');

        $this->view->user = $model->getUser($id);
        $this->view->comments = $comments->getUserComments($id);
        $this->view->events = $events->getUserEvents($id);
        $this->view->render('user/view');
    }
}