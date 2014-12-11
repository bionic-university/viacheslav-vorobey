<?php
/**
 * Eventmapia
 *
 * @author vorobeyme
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */
 
namespace BionicUniversity\Eventmapia\Models;

use BionicUniversity\Eventmapia\Core\Model;
use BionicUniversity\Eventmapia\Core\Auth\AuthException;


/**
 * Model User
 */
class User extends Model
{
    const USER_ACTIVE = 1;

    /** @var string $table */
    private $table = 'user';

    /** @var int $userId */
    public $userId;

    /**
     * Return the table name
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login($email, $password)
    {
        if ($this->checkPassword($email, $password)) {
            $this->userId = $this->checkPassword($email, $password);

            return true;
        }

        return false;
    }

    /**
     * Register user
     * @param array $data
     * @throws AuthException
     * @return void
     */
    public function registerUser(array $data)
    {
        $email = strtolower($data['email']);
        $password = $this->hashPassword($data['password']);
        $username = $data['username'];
        $created_time = date('Y-m-d H:i:s');
        $active = self::USER_ACTIVE;

        if ($this->uniqueEmail($email)) {
            throw new AuthException('This email is used by another user');
        }

        $sql = "INSERT INTO `user` (`email`, `password`, `username`, `created_time`, `active`, `admin`)
                       VALUES (:email, :password, :username, :created_time, :active, :admin)";
        $params = [
            'email' => $email,
            'password' => $password,
            'username' => $username,
            'created_time' => $created_time,
            'active' => $active,
            'admin' => 0
        ];

        $this->db->query($sql, $params, ['active' => \PDO::PARAM_INT, 'admin' => \PDO::PARAM_INT]);
    }


    /**
     * Return a hash password
     * @param string $password
     * @return string
     *
     * @TODO: Make a good hash func
     */
    public function hashPassword($password) {
        return sha1($password);
    }

    /**
     * Check if email is an unique
     * @param string $email
     * @return bool
     */
    public function uniqueEmail($email)
    {
        $uniqueEmail = $this->db->fetchColumn('SELECT `email` FROM `user` WHERE `email` = :email', [':email' => $email]);

        if ($uniqueEmail) {
            return true;
        }

        return false;
    }

    /**
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function checkPassword($email, $password)
    {
        $hashPassword = $this->db->fetchRow('SELECT `id`, `password` FROM `user` WHERE email = :email', [':email' => $email]);

        if ($hashPassword && $this->hashPassword($password) === $hashPassword['password']) {
            return $hashPassword['id'];
        }

        return false;
    }

    public function getUser($id)
    {
        $sql = 'SELECT u.id, u.username
                FROM user u
                WHERE u.id = :id';
        $result = $this->db->fetchRow($sql, ['id' => $id]);

        if (!$result) {
            throw new \Exception("User doesn't exist");
        }

        return $result;
    }
}
