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
class DashboardController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->render('dashboard/index');
    }
}