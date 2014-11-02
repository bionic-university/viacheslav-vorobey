<?php

trait MaterialTrait
{
    /**
     * Get language
     *
     * @return TranslatableInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Get class name
     *
     * @return string
     */
    public function __toString()
    {
        parent::__toString();
    }
}