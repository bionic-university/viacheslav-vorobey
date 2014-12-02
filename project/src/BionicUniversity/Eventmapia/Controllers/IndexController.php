<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use BionicUniversity\Eventmapia\Models\Events;

/**
 * IndexController
 *
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $model = $this->loadModel('events');
        $events = $model->getAllEvents();

        $this->view->events = $events;
        $this->view->render('index/index');
    }

    public function registrationAction()
    {
        $model = $this->loadModel('user');

        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $password = $this->request->getParam('password');
            $name = $this->request->getParam('name');

            if (!empty($email) && !empty($password) && !empty($name)) {
                $data = [
                    'email' => $email,
                    'password' => $password,
                    'username' => $name,
                ];

                $model->registerUser($data);
                $this->redirect('/web/user/cabinet');
            } else {
                $this->redirect('/web/index/registration');
            }
        }

        $this->view->render('index/registration');
    }

    public function loginAction()
    {
        //print_r($this->session->get(5));
        //print_r($_SESSION);

        if (!$this->auth->isGuest()) {
            $this->redirect('/web/index/index'); //must be return url
        }

        $model = $this->loadModel('user');

        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $password = $this->request->getParam('password');

            if (!empty($email) && !empty($password) && $model->login($email, $password)) {
                $this->auth->login($model->userId);
                $this->redirect('/web/user/cabinet');
            } else {
                $this->redirect('/web/index/login');
            }
            print_r($this->session->get(5));
            print_r($_SESSION);

            session_start();
            $_SESSION['auth'] = md5(5);
        }

        $this->view->render('index/login');
    }

    /**
     * Logout the current user and redirect to homepage.
     */
    public function logoutAction()
    {
        $this->auth->logout();
        print_r($_SESSION);
        //$this->redirect('/web/index/index');
    }
}
