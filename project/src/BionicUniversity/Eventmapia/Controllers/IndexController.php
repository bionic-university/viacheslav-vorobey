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
        if (!$this->auth->isGuest()) {
            $this->redirect('/web/index/index');
        }

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
        if (!$this->auth->isGuest()) {
            $this->redirect('/web/index/index');
        }

        $model = $this->loadModel('user');

        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $password = $this->request->getParam('password');

            if (!empty($email) && !empty($password) && $model->login($email, $password)) {
                $this->auth->login($model->userId);

                $returnUrl = $this->session->get('returnUrl');
                if (isset($returnUrl)) {
                    $this->redirect($this->session->get('returnUrl'));
                    $this->session->remove('returnUrl');
                } else {
                    $this->redirect('/web/index/index');
                }

            } else {
                $this->redirect('/web/index/login');
            }
        }

        $this->view->render('index/login');
    }

    /**
     * Logout the current user and redirect to homepage
     */
    public function logoutAction()
    {
        $this->auth->logout();
        $this->redirect('/web/index/index');
    }
}
