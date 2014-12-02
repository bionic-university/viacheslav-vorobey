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
    public function getAllEvents()
    {
        $result = $this->db->fetchAll('SELECT * FROM `event`');

        if (!count($result)) {
            return false;
        }

        return $result;
    }

    public function getEvent($id)
    {
        $result = $this->db->fetchRow('SELECT * FROM `event` WHERE id = :id', ['id' => $id]);

        return $result;
    }

    public function addEvent(array $data)
    {

        $title = $data['title'];
        $description = $data['description'];
        $date = date('Y-m-d H:i:s');
        $created_time = date('Y-m-d H:i:s');
        $user_id = 5;

        $sql = "INSERT INTO `event` (`title`, `description`, `date`, `created_time`, `user_id`)
                       VALUES (:title, :description, :date, :created_time, :user_id)";
        $params = [
            'title' => $title,
            'description' => $description,
            'date' => $date,
            'created_time' => $created_time,
            'user_id' => $user_id
        ];

        $res = $this->db->query($sql, $params, ['user_id' => \PDO::PARAM_INT]);
        print_r($res);

    }
}