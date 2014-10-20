<?php

class PalindromesDetector
{
    /**
     * @var string
     */
    private $_inputString;
    
    /** 
     * @param $inputString
     */
    public function __construct($inputString) 
    {
        $this->_inputString = $this->_prepareInputString($inputString);
    }
    
    /**
     * Clean input data
     *
     * @param $inputString
     * @return string
     * @throws InvalidArgumentException
     */
    private function _prepareInputString($inputString)
    {
        if (!is_string($inputString))
        {
            throw new InvalidArgumentException('Input arguments must be a string');
        }
        else
        {
            $inputString = strtolower(trim($inputString));
            return str_replace(array(",", " ", "'", "&nbsp;"), "", $inputString);
        }
    }
    
    /**
     * @return boolean
     */
    public function findPalindrome()
    {
        return $this->_isPalindrome($this->_inputString);
    }
    
    /**
     * Check for palindrome 
     * @param string $inputString The input string to check for a palindrom
     * @return boolean     
     */ 
    private function _isPalindrome($inputString)
    {
        $stringLength = strlen($inputString) - 1;
        
        if (strlen($inputString) <= 1)
        {
            return true;
        }
        else 
        {
            if (substr($inputString, 0, 1) === substr($inputString, $stringLength, 1))
            {
                return $this->_isPalindrome(substr($inputString, 1, $stringLength - 1));
            }
            else
            {
                return false;
            }
            
            //return ($inputString === strrev($inputString));
        }
    }

}
