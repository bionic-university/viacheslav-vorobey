<?php

class Magazine extends Material implements TranslatableInterface
{
    use MaterialTrait;

    /**
     * @param string $language Language
     */
    public function __construct($language = null)
    {
        parent::__construct();
        if (!is_null($language)) {
        	$this->language = $language;
        }
    }
}