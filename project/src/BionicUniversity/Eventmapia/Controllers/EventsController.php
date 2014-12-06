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
     * @param int id
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

        //if (isset($_POST['func']) and !empty($_POST['func'])) echo "Сообщение отправлено!";

        $id = abs((int) $id);
        $model = $this->loadModel('events');
        $comments = $this->loadModel('comment');

        $this->view->event = $model->getEvent($id);
        $this->view->comments = $comments->getComments($id);
        $this->view->render('events/view');
    }

    /**
     * Accept action
     * @param int $id
     * @throws \Exception
     */
    public function acceptAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        $userId = 1;

        $model = $this->loadModel('events');

        $model->acceptEvent($eventId, $userId);
        $this->redirect("/web/events/view/{$id}");
    }

    /**
     * Cancel action
     * @param int $id
     * @throws \Exception
     */
    public function cancelAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        //$userId;

        $model = $this->loadModel('events');
        
        if ($model->cancelEvent($eventId, $userId)) {
            $this->redirect("/web/events/view/{$id}");
        }
    }

    /**
     * Delete action
     * @param int $id
     * @throws \Exception
     */
    public function deleteAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $id = abs((int) $id);
        $model = $this->loadModel('events');

        $model->deleteEvent($id);

        //if ($model->deleteEvent($id)) {
        //    $this->redirect("/web/index/index/");
        //}
    }

    public function addcommentAction()
    {
        $model = $this->loadModel('comment');

        if ($this->request->isPost()) {
            $comment = $this->request->getParam('comment');
            $eventId = $this->request->getParam('event_id');

            if (!empty($comment) && !empty($eventId)) {
                $data = [
                    'text' => $comment,
                    'user_id' => 2,
                    'event_id' => $eventId,
                ];
                $model->addComment($data);
                $this->redirect('/web/events/view/' . $eventId);
            }

            $this->redirect('/web/events/view/' . $eventId);
        }

        return false;
    }
}
