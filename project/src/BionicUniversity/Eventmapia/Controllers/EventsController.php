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
 * EventsController
 */
class EventsController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->view->render('events/index');
    }

    /**
     * Add action
     */
    public function addAction()
    {
        $model = $this->loadModel('events');

        if ($this->request->isPost()) {
            $title = $this->request->getParam('title');
            $date = $this->request->getParam('date');
            $description = $this->request->getParam('description');

            if (!empty($title) && !empty($date) && !empty($description)) {
                $data = [
                    'title' => $title,
                    'date' => $date,
                    'description' => $description,
                ];

                $model->addEvent($data);
                $this->redirect('/web/index/index');
            } else {
                $this->redirect('/web/events/add');
            }
        }

        $this->view->render('events/add');
    }

    /**
     * Edit action
     */
    public function editAction($id)
    {
       
    }

    /**
     * View action
     * @param int $id
     */
    public function viewAction($id = null)
    {
        echo 'EventsController :: viewAction :: params ' . $id;
    }
    
    /**
     * Delete action
     */
    public function deleteAction($id)
    {
        
    }
}