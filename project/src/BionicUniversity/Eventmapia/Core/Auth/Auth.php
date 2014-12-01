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
    /** @var */
    private $loggedOut;

    /** @var */
    private $session;

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
        return $this->loggedOut;
    }
    
    /**
     * @param int $userId
     * @return void
     */
    public function login($userId)
    {
        $this->session->set($userId, $this->generateHash($userId));
        $this->loggedOut = false;
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->remove($this->getName());
        $this->loggedOut = true;
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
}
