<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Controllers;

use BionicUniversity\Eventmapia\Core\Controller;
use Ivory\GoogleMap\Helper\Geometry\EncodingHelper;
use Ivory\GoogleMap\Overlays\EncodedPolyline;
use Ivory\GoogleMap\Services\Base\TravelMode;
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

        /** Google Maps API */
        $map = new Map();
        $markerPositions = [];

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
            'right'     => '4px',
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

                $legs = $route->getLegs();
                foreach ($legs as $leg) {
                    // Gets the start location
                    $startLocation = $leg->getStartLocation();
                    $startLatitude = $startLocation->getLatitude();
                    $startLongitude = $startLocation->getLongitude();

                    // Gets the end location
                    $endLocation = $leg->getEndLocation();
                    $endLatitude = $endLocation->getLatitude();
                    $endLongitude = $endLocation->getLongitude();

                    $markerPositions = [
                        'start' => [$startLatitude, $startLongitude],
                        'end' => [$endLatitude, $endLongitude],
                    ];

                    $distance = $leg->getDistance(); // Gets the distance
                    $leg->getDuration();             // Gets the duration
                    $leg->getStartAddress();         // Gets the start address
                    $leg->getEndAddress();           // Gets the end address


                    // Gets the directions steps.
                    $steps = $leg->getSteps();
                    foreach ($steps as $step) {
                        $distance = $step->getDistance();           // Gets the distance.
                        $duration = $step->getDuration();           // Gets the duration.
                        $startLocation = $step->getStartLocation(); // Gets the start location.
                        $endLocation = $step->getEndLocation();     // Gets the end location.
                        $instructions = $step->getInstructions();   // Gets the instructions.
                        $travelMode = $step->getTravelMode();       // Gets the travel mode.
                    }
                }
            }

            // Build marker
            $positionStart = new Coordinate($startLatitude, $startLongitude, true);
            $positionEnd = new Coordinate($endLatitude, $endLongitude, true);

            $markerStart = new Marker($positionStart, 'drop', null, null, null, new InfoWindow());
            $markerEnd = new Marker($positionEnd, 'drop', null, null, null, new InfoWindow());

            $map->addMarker($markerStart);
            $map->addMarker($markerEnd);

            // Build Polyline
            $encodedPolyline = new EncodedPolyline();
            $encodedPolyline->setValue($overviewPolyline->getValue());
            $encodedPolyline->setOptions(array(
                'geodesic'    => true,
                'strokeColor' => '#3079ed',
                'strokeOpacity' => 0.8,
                'strokeWeight' => 5
            ));
            $map->addEncodedPolyline($encodedPolyline);

            // Kyiv
            //$map->setCenter(new Coordinate(50.43, 30.52, true));
            //$map->setMapOption('zoom', 10);
        }

        // Render map
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
