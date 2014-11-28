<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

namespace BionicUniversity\Eventmapia\Core;

/**
 * Class Session
 */
class Session
{
    /**
     * Start session
     */
    public function start()
    {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->start();

        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = $value;
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function destroy($key)
    {
        if (session_id()) {
            session_destroy();
            return true;
        }
        return false;

        //unset($_SESSION[$key]);
    }
}