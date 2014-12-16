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
    public $loggedIn;

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
        if ($this->session->get('user_agent') == $this->getUserAgent() && $this->session->get('user_id')) {
            return false;
        }

        return true;
    }

    /**
     * @param int $userId
     * @return void
     */
    public function login($userId)
    {
        $this->session->set('user_id', $this->generateHash($userId));
        $this->session->set('uid', $userId);
        $this->session->set('user_agent', $this->getUserAgent());

        $this->setUser($userId);
        $this->loggedIn = true;
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->remove('user_id');
        $this->session->remove('user_agent');
        $this->session->remove('uid');

        $this->unsetUser();
        $this->loggedIn = false;
    }

    /**
     * Generate a hash
     * @param string $param
     * @return string
     */
    public function generateHash($param)
    {
        return md5($param);
    }

    /**
     * Get user agent
     * @return string
     */
    public function getUserAgent()
    {
        return $this->generateHash($_SERVER['HTTP_USER_AGENT']);
    }

    /**
     * Set user ID
     * @param $user
     * @return void
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user ID
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Remove user ID
     * @return void
     */
    public function unsetUser()
    {
        $this->user = null;
    }
}
