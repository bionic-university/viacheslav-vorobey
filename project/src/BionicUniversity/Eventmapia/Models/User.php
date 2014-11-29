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
 * Model User
 */
class User extends Model
{
    /** @var string $table */
    private $table = 'user';

    /**
     * Return the table name
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * test
     */
    public function add()
    {
        //$this->db->insert($this->table, ['email' => ''])
    }

    public function login()
    {

    }
}