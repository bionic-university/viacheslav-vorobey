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
 * Class CalendarController
 */
class CalendarController extends Controller
{
    /**
     * Render calendar
     */
    public function indexAction()
    {
        $this->view->render('calendar/index');
    }

    /**
     * Get all events via JSON
     * @return string
     */
    public function eventsAction()
    {
        $model = $this->loadModel('Events');
        $events = $model->getAllEvents();
        $data = [];

        foreach ($events as $event) {
            $date = new \DateTime($event['date']);

            $data[] = [
                'id' => $event['id'],
                'title' => $event['title'],
                'description' => $event['description'],
                'url' => '/web/events/view/' . $event['id'],
                'start' => $date->format('c'),
                'end' => $event['end_date']
            ];
        }

        echo json_encode($data);
    }
}
