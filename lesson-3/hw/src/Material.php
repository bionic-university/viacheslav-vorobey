<?php

abstract class Material
{
    /**
     * @var string $language
     */
    protected $language = 'en';

    /**
     * @param string $language Language
     */
    public function __construct(){}
    
    /**
     * Get class name
     * 
     * @return string
     */
    public function __toString()
    {
        return __CLASS__;
    }
}