<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

namespace BionicUniversity\Eventmapia\Core\Auth;

use BionicUniversity\Eventmapia\Core\Session;

/**
 * Class Auth
 *
 */
class Auth
{
    /** @var bool $loggedIn */
    private $loggedIn;

    /** @var object $session */
    private $session;

    /** @var int $user */
    private $user;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->session = new Session;
    }

    /**
     * Check if the current user is a guest
     * @return bool
     */
    public function isGuest()
    {
        if ($this->session->get($this->user)) {

            print_r($this->user);
            return false;
        }

        print_r($this->user);
        return true;

    }

    /**
     * @param int $userId
     * @return void
     */
    public function login($userId)
    {
        $this->session->set($userId, $this->generateHash($userId));

        $this->user = $userId;
        $this->loggedIn = true;
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->remove($this->getUser());

        $this->user = null;
        $this->loggedIn = false;
    }

    /**
     * Generate a hash
     * @param string $param
     * @return string
     */
    public function generateHash($param)
    {
        return sha1($param);
    }

    /**
     * Get user ID
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }
}
