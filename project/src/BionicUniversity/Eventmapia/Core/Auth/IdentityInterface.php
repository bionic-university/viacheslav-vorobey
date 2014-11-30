<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core\Auth
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

namespace BionicUniversity\Eventmapia\Core\Auth;

/**
 * Interface IdentityInterface
 */
interface IdentityInterface
{
    /**
     * @param int $id
     * @return
     */
    public function findIdentity($id);

    /**
     * @return
     */
    public function getId();

} 