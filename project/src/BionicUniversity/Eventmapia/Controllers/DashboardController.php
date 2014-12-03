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
 * DashboardController
 */
class DashboardController extends BackendController
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->init();
        $this->view->render('dashboard/dashboard/index');
    }
}
