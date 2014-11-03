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
    private $languages = [];
    
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
            exit;
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
        if (is_array($language)) {
            $this->languages = $language;
        } elseif (is_string($language)) {
            $this->languages = explode(',', $language);
        } else {
            throw new InvalidArgumentException('Arguments must be a string or array!' . PHP_EOL);
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
     * @param TranslatableInterface $material
     * @throws Exception
     *
     * @return mixed
     */
    public function translate(TranslatableInterface $material)
    {
        $isAvailableLanguage = true;
        
        if ($material instanceof TranslatableInterface) {
            $this->setMaterial($material);
        } else {
            throw new \Exception('It is not a valid class');
        }
        
        $materialLanguage = $this->material->getLanguage();
        $translatorLanguages = $this->getLanguages();
        
        if (!in_array($materialLanguage, $translatorLanguages)) {
            $isAvailableLanguage = false;
            //return false;
        }

        return $this->showTranslations($this->material->getMaterialName(), $materialLanguage, $isAvailableLanguage);
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
            $outputString .= 'Successfully translated | ' . $materialLanguage  . ' | ' . $materialName;
        } else {
            $outputString .= 'Not translated          | ' . $materialLanguage . ' | ' . $materialName;
        }

        echo $outputString . PHP_EOL;
    }
}