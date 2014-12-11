<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\BackendController;

/**
 * DashboardController
 */
class DashboardController extends BackendController
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->render('dashboard/index');
    }

    /**
     * Events action
     */
    public function eventsAction()
    {
        $this->view->render('dashboard/events');
    }

    /**
     * Users action
     */
    public function usersAction()
    {
        $this->view->render('dashboard/users');
    }

    /**
     * Comments action
     */
    public function commentsAction()
    {
        $this->view->render('dashboard/comments');
    }

    /**
     * Settings action
     */
    public function settingsAction()
    {
        $this->view->render('dashboard/settings');
    }
}
