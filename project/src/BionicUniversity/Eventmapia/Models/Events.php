<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Models;

use BionicUniversity\Eventmapia\Core\Model;

/**
 * Events model
 */
class Events extends Model
{
    const ADMIN_ID = 1;

    /**
     * Get all events
     * @return array $result
     * @throws \Exception
     */
    public function getAllEvents($limit = null)
    {
        $sql = 'SELECT e.id, e.title, e.description, e.date, e.end_date, e.user_id, u.username
                FROM event e
                LEFT JOIN user u ON e.user_id = u.id
                ORDER BY e.created_time DESC';

        if (!is_null($limit) && is_int($limit)) {
            $sql .= " LIMIT $limit";
        }

        $result = $this->db->fetchAll($sql);

        if (!$result) {
            throw new \Exception("Events doesn't exist");
        }

        return $result;
    }

    /**
     * Get one event
     * @param int $id
     * @return array $result
     * @throws \Exception
     */
    public function getEvent($id)
    {
        $sql = 'SELECT e.id, e.title, e.description, e.destinations, e.date, e.end_date, e.user_id, u.username
                FROM event e
                LEFT JOIN user u ON e.user_id = u.id
                WHERE e.id = :id';
        $result = $this->db->fetchRow($sql, ['id' => $id]);

        if (!$result) {
            throw new \Exception("Event doesn't exist");
        }

        $destinations = unserialize($result['destinations']);
        unset($result['destinations']);

        $result['routeFrom'] = $destinations['routeFrom'];
        $result['latFrom'] = $destinations['latFrom'];
        $result['lngFrom'] = $destinations['lngFrom'];
        $result['routeTo'] = $destinations['routeTo'];
        $result['latTo'] = $destinations['latTo'];
        $result['lngTo'] = $destinations['lngTo'];
        $result['routeMode'] = $destinations['routeMode'];

        return $result;
    }

    /**
     * Add new event to DB
     * @param array $data
     * @return int Number of affected rows
     */
    public function addEvent(array $data)
    {
        // Prepare data
        $date = new \DateTime($data['date']);
        if (!empty($data['end_date'])) {
            $endDate = new \DateTime($data['end_date']);
            $data['end_date'] = $endDate->format('Y-m-d H:i:s');
        }

        $data['user_id'] = !empty($data['user_id']) ? $data['user_id'] : self::ADMIN_ID;
        $data['date'] = $date->format('Y-m-d H:i:s');
        $data['created_time'] = date('Y-m-d H:i:s');

        $latlngFrom = $this->getLatLngFromAddress($data['destinations']['routeFrom']);
        $latlngTo = $this->getLatLngFromAddress($data['destinations']['routeTo']);
        $destinations = [
            'routeFrom' => $data['destinations']['routeFrom'],
            'latFrom'   => $latlngFrom['lat'],
            'lngFrom'   => $latlngFrom['lng'],
            'routeTo'   => $data['destinations']['routeTo'],
            'latTo'     => $latlngTo['lat'],
            'lngTo'     => $latlngTo['lng'],
            'routeMode' => $data['destinations']['routeMode']
        ];

        $data['destinations'] = serialize($destinations);

        return $this->db->insert('event', $data);
    }

    /**
     * Accept event
     * @param int $eventId
     * @param int $userId
     */
    public function acceptEvent($eventId, $userId)
    {
        $this->db->insert('event_user', ['event_id' => $eventId, 'user_id' => $userId]);
    }

    /**
     * Cancel event
     * @param int $eventId
     * @param int $userId
     * @return int Number of affected rows
     */
    public function cancelEvent($eventId, $userId)
    {
        return $this->db->delete('event_user', ['event_id' => $eventId, 'user_id' => $userId]);
    }

    /**
     * Delete event
     * @param int $eventId
     * @return int Number of affected rows
     */
    public function deleteEvent($eventId)
    {
        return $this->db->delete('event', ['event_id' => $eventId]);
    }

    /**
     * @param int $eventId
     * @param int $userId
     * @return bool
     */
    public function checkJoinedUser($eventId, $userId)
    {
        $sql = 'SELECT event_id, user_id FROM event_user WHERE event_id = :eid AND user_id = :uid';
        $result = $this->db->fetchAll($sql, ['eid' => $eventId, 'uid' => $userId]);

        return $result ? true : false;
    }

    /**
     * @param int $eventId
     * @return array
     */
    public function getAttendingUsers($eventId)
    {
        $sql = 'SELECT eu.user_id, u.username
                FROM event_user eu
                JOIN user u ON eu.user_id = u.id
                WHERE event_id = :eid';
        $result = $this->db->fetchAll($sql, ['eid' => $eventId]);

        return $result;
    }

    /**
     * Get all events by userID
     * @param $userId
     * @return array
     */
    public function getUserEvents($userId)
    {
        $sql = 'SELECT * FROM event
                WHERE user_id = :user_id
                ORDER BY created_time DESC';
        $result = $this->db->fetchAll($sql, [':user_id' => $userId]);

        return $result;
    }


    /**
     * Returns latitude and longitude from an address
     * @param string $address
     * @return array
     */
    public function getLatLngFromAddress($address)
    {
        $result = [];

        $prepareAddress = str_replace(' ', '+', $address);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepareAddress . '&sensor=false');

        $output = json_decode($geocode);

        $result['lat'] = $output->results[0]->geometry->location->lat;
        $result['lng'] = $output->results[0]->geometry->location->lng;

        return  $result;
    }
}
