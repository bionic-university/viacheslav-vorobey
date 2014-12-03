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
        $this->redirect('/web/index/index');
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
     * @throws \Exception
     */
    public function viewAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $id = abs((int) $id);
        $model = $this->loadModel('events');

        $this->view->event = $model->getEvent($id);
        $this->view->render('events/view');
    }

    /**
     * Accept action
     */
    public function acceptAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        //$userId

        $model = $this->loadModel('events');
        
        if ($model->acceptEvent($eventId, $userId)) {
            $this->redirect("/web/events/view/{$id}");
        }
    }

    /**
     * Cancel action
     */
    public function cancelAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        //$userId;

        $model = $this->loadModel('events');
        
        if ($model->rejectEvent($eventId, $userId)) {
            $this->redirect("/web/events/view/{$id}");
        }
    }

    /**
     * Delete action
     */
    public function deleteAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $id = abs((int) $id);
        $model = $this->loadModel('events');
        
        if ($model->deleteEvent($id)) {
            $this->redirect("/web/index/index/");
        }
    }
}
