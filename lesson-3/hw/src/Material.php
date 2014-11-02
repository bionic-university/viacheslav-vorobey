<?php

abstract class Material
{
    /**
     * @var string $language
     */
    protected $language = 'en';

    /**
     * Constructor
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