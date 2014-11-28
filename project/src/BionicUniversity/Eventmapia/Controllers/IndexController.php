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
 * IndexController
 *
 */
class IndexController extends Controller
{
    public function indexAction()
    {
        $events = $this->loadModel('events');

        $this->view->render('index/index', [
            'events' => $events
        ]);
    }

    public function registrationAction()
    {
        $model = $this->loadModel('user');
        //print_r($model);

        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $password = $this->request->getParam('password');
            $name = $this->request->getParam('name');

            if (isset($email, $password, $name) && !empty($email) && !empty($password) && !empty($name)) {
                $data = [
                    'email' => $email,
                    'password' => md5($password),
                    'username' => $name,
                    'active' => 1
                ];

                $model->db->insert($model->getTable(), $data);
                //$model->registerUser($data);
            }

            $this->redirect('/web/index/index');
        }

        $this->view->render('index/registration');
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            $email = $this->request->getParam('email');
            $password = $this->request->getParam('password');

            if (isset($email, $password) && !empty($email) && !empty($password)) {
                $data = [
                    'email' => $email,
                    'password' => $password,
                ];

                $this->redirect('/web/user/index');
            } else {
                $this->redirect('/web/index/login');
            }
        }

        $this->view->render('index/login');
    }

    public function logoutAction()
    {
        // @TODO: destroy
        $this->redirect('/web/index/index');
    }
}