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
    /**
     * Get all events
     * @return array $result
     * @throws \Exception
     */
    public function getAllEvents()
    {
        $sql = 'SELECT e.id, e.title, e.description, e.date, e.user_id, u.username
                FROM event e
                LEFT JOIN user u ON e.user_id = u.id';
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
        $sql = 'SELECT e.id, e.title, e.description, e.date, e.user_id, u.username
                FROM event e
                LEFT JOIN user u ON e.user_id = u.id
                WHERE e.id = :id';
        $result = $this->db->fetchRow($sql, ['id' => $id]);

        if (!$result) {
            throw new \Exception("Event doesn't exist");
        }

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
        $data['date'] = date('Y-m-d H:i:s');
        $data['created_time'] = date('Y-m-d H:i:s');
        $data['user_id'] = 5;

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
}
