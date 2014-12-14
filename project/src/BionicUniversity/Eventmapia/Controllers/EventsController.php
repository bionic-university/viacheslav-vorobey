<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\Base\UnitSystem;
use Ivory\GoogleMap\Services\Directions\DirectionsRequest;
use Widop\HttpAdapter\CurlHttpAdapter;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Services\Directions\Directions;


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
                    'end_date' => $params['endDate'],
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
        $userId = $this->session->get('uid');

        $model = $this->loadModel('events');
        $comments = $this->loadModel('comment');
        $event = $model->getEvent($id);

        $isJoined = $model->checkJoinedUser($id, $userId);
        $attendingUsers = $model->getAttendingUsers($id);

        /** Google Maps API */
        $map = new Map();
        $markerPositions = $instructions = $commonInfo = [];

        $map->setLanguage('uk');
        $map->setAutoZoom(true);
        $map->setPrefixJavascriptVariable('map_');
        $map->setHtmlContainerId('map-canvas-view');

        $map->setMapOptions(array(
            'disableDefaultUI' => true,
            'disableDoubleClickZoom' => true,
            'mapTypeId' => 'roadmap',
        ));

        $map->setStylesheetOptions(array(
            'width'     => '58%',
            'height'    => 'calc(100% - 0)',
            'position'  => 'absolute',
            'right'     => '0px',
            'top'       => '50px',
            'bottom'    => '2px',
            'overflow'  => 'hidden',
        ));

        // Build directions
        $request = new DirectionsRequest();
        $request->setLanguage('uk');
        $request->setUnitSystem(UnitSystem::METRIC);
        $request->setTravelMode($event['routeMode']);
        $request->setOrigin($event['routeFrom']);
        $request->setDestination($event['routeTo']);

        // @TODO: Do it
        // $request->addWaypoint($event['routeVia']);
        // $request->setOptimizeWaypoints(true);
        // $request->setAvoidHighways(true);
        // $request->setAvoidTolls(true);
        // $request->setProvideRouteAlternatives(true);

        $directions = new Directions(new CurlHttpAdapter());
        $response = $directions->route($request);

        if ($response->getStatus() === 'OK') {

            $routes = $response->getRoutes();
            foreach ($routes as $route) {

                $overviewPolyline = $route->getOverviewPolyline();
                //$waypointOrder = $route->getWaypointOrder();  // Get the waypoint order

                foreach ($route->getLegs() as $leg) {
                    // Set the start location & the end location into array
                    $markerPositions = [
                        'start' => [
                            $leg->getStartLocation()->getLatitude(),
                            $leg->getStartLocation()->getLongitude()
                        ],
                        'end' => [
                            $leg->getEndLocation()->getLatitude(),
                            $leg->getEndLocation()->getLongitude()
                        ],
                    ];

                    $commonInfo = [
                        'distance' => $leg->getDistance()->getText(), //getValue()
                        'duration' => $leg->getDuration()->getText(), //getValue()
                        'startAddress' => $leg->getStartAddress(),
                        'endAddress' => $leg->getEndAddress(),
                    ];

                    // Set the directions steps
                    foreach ($leg->getSteps() as $key => $step) {
                        $instructions[] = [
                            $step->getInstructions(),
                            $step->getDistance()->getText(),
                            $step->getDuration()->getText(),
                            $step->getTravelMode(),
                        ];
                    }
                }
            }

            // Build markers
            foreach ($markerPositions as $latlng) {
                $position = new Coordinate($latlng[0], $latlng[1], true);
                $marker = new Marker($position, 'drop', null, null, null, new InfoWindow());
                $map->addMarker($marker);
            }

            // Build Polyline
            $encodedPolyline = new EncodedPolyline();
            $encodedPolyline->setValue($overviewPolyline->getValue());
            $encodedPolyline->setOptions(array(
                'geodesic' => true,
                'strokeColor' => '#3079ed',
                'strokeOpacity' => 0.8,
                'strokeWeight' => 5
            ));
            $map->addEncodedPolyline($encodedPolyline);
        }

        // Render map
        $mapHelper = new MapHelper();

        $this->view->map = $mapHelper->render($map);
        $this->view->event = $event;
        $this->view->comments = $comments->getComments($id);
        $this->view->commentsAccess = (bool) $userId;
        $this->view->isJoined = (bool) $isJoined;
        $this->view->attendingUsers = $attendingUsers;
        $this->view->instructions = $instructions;
        $this->view->render('events/view');
    }

    /**
     * Accept action
     * @param int $id
     * @throws \Exception
     *
     * @TODO: via Ajax
     */
    public function acceptAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        $userId = (int) $this->session->get('uid');

        $model = $this->loadModel('events');

        $model->acceptEvent($eventId, $userId);
        $this->redirect("/web/events/view/{$id}");
    }

    /**
     * Cancel action
     * @param int $id
     * @throws \Exception
     *
     * @TODO: via Ajax
     */
    public function cancelAction($id = null)
    {
        if (is_null($id)) {
            throw new \Exception('Bad request');
        }

        $eventId = abs((int) $id);
        $userId = (int) $this->session->get('uid');

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
        $this->redirect('/web/index/index/');
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
