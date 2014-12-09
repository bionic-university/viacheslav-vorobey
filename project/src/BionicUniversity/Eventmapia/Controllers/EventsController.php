<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;

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
        if ($this->auth->isGuest()) {
            // @TODO: returnUrl
            $this->session->set('returnUrl', '/web/events/add');
            $this->redirect('/web/index/login');
        }

        $model = $this->loadModel('events');

        if ($this->request->isPost()) {
            $params = $this->request->getParam();

            if (!empty($params['title']) && !empty($params['description']) && !empty($params['date']) && !empty($params['routeTo'])) {

                $destinations = [
                    'routeFrom' => $params['routeFrom'],
                    'routeTo'   => $params['routeTo'],
                    'routeMode' => $params['mode'][0]
                ];

                $data = [
                    'title' => $params['title'],
                    'date' => $params['date'],
                    'description' => $params['description'],
                    'user_id' => $this->session->get('uid'),
                    'destinations' => serialize($destinations),
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

        $event = $model->getEvent($id);


        $map = new Map();

        // Configure map
        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map-canvas-view');

        $map->setAsync(false);
        $map->setAutoZoom(false);

        // Set the position (default: Kyiv)
        $position = new Coordinate(50.43, 30.52, true);

        $map->setCenter($position);
        $map->setMapOption('zoom', 10);

        //$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $map->setMapOption('mapTypeId', 'roadmap');

        $map->setMapOptions(array(
            'disableDefaultUI'       => true,
            'disableDoubleClickZoom' => true,
        ));

        $map->setStylesheetOptions(array(
            'width'     => '58%',
            'height'    => 'calc(100% - 0)',
            'position'  => 'absolute',
            'right'     => '4px',
            'top'       => '50px',
            'bottom'    => '2px',
            'overflow'  => 'hidden',
        ));

        /** Build marker */
        $marker = new Marker($position, 'drop', null, null, null, new InfoWindow());
        $marker->setOptions(array(
            'clickable' => false,
            'flat'      => true,
        ));

        $map->addMarker($marker); //bounce

        /** Set default language as Ukrainian */
        $map->setLanguage('uk');


        /** Render map */
        $mapHelper = new MapHelper();
        $this->view->map = $mapHelper->render($map);


        $this->view->event = $event;
        $this->view->comments = $comments->getComments($id);
        $this->view->commentsAccess = (bool)$this->session->get('user_id');
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
