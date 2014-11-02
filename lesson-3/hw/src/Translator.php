<?php

class Translator
{
   /**
    * @var object $material
    */
    private $material;
    
   /**
    * @var array $languages
    */
    private $languages = ['uk', 'en', 'de'];
    
   /**
    * Constructor
    * 
    * @param $language Given languages
    */
    public function __construct($language)
    {
        try {
            $this->setLanguages($language);
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }    
    
    /**
     * Set languages
     *
     * @return void
     */
    private function setLanguages($language)
    {
        // Validation
        if (!is_string($language)) {// or !is_array($language)) {
            throw new InvalidArgumentException('Arguments must be a string or array!' . PHP_EOL);
        }
        
        if (is_array($language)) {
            $this->languages = $language;
        } else {
            $this->languages = explode(',', $language);
        }
    }
    
    /**
     * Get languages
     *
     * @return array
     */
    private function getLanguages()
    {
        return $this->languages;
    }
    
    /**
     * Set material
     * 
     * @param TranslatableInterface $material Materials
     */
    private function setMaterial(TranslatableInterface $material)
    {
        $this->material = $material;
    }
    
    /**
     * Translate given materials
     * 
     * @param
     * @throws 
     *
     * @return mixed
     */
    public function translate(TranslatableInterface $material)
    {
        $isAvailableLanguage = true;
        
        if ($material instanceof TranslatableInterface) {
            $this->setMaterial($material);
        } else {
            throw new \Exception('Input material is not a valid class');
        }
        
        $materialLanguage = (array)$this->material->getLanguage();
        $translatorLanguages = $this->getLanguages();

        
        print_r($materialLanguage);
        print_r($translatorLanguages);
        //die;
        
        if (!in_array($translatorLanguages, $materialLanguage)) {
            $isAvailableLanguage = false;
            return false;
        }
        return $this->showTranslations($this->material->__toString(), $materialLanguage, $isAvailableLanguage);
    }
    
    /**
     * Show translations
     * 
     * @param string $materialName
     * @param string $materialLanguage
     * @param boolean $isAvailableLanguage
     *
     * @return void
     */
    private function showTranslations($materialName, $materialLanguage, $isAvailableLanguage)
    {
        $outputString = '';
        
        if ($isAvailableLanguage) {
            $outputString .= $materialName . ' - ' . $materialLanguage;
        } else {
            $outputString .= $materialName . ' - ' . $materialLanguage;
        }
        
        echo $outputString . PHP_EOL;
    }
}