<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

namespace BionicUniversity\Eventmapia\Models;

use BionicUniversity\Eventmapia\Core\Model;

class Comment extends Model
{
    /**
     * Get comments by event ID
     * @param $eventId
     * @throws \Exception
     * @return array
     */
    public function getComments($eventId)
    {
        $sql = 'SELECT c.id, c.text, c.created_time, c.user_id, u.username
                FROM comment c
                LEFT JOIN user u ON c.user_id = u.id
                WHERE c.event_id = :event_id
                ORDER BY c.created_time DESC';
        $result = $this->db->fetchAll($sql, [':event_id' => $eventId]);

        return $result;
    }

    /**
     * @param array $data
     * @return int
     * @throws \Exception
     */
    public function addComment(array $data)
    {
        $data['created_time'] = date('Y-m-d H:i:s');
        return $this->db->insert('comment', $data);
    }
}
