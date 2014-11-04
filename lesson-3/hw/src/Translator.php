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
    
    public function __construct()
    {
        $this->setLanguages();
    }    
    
    /**
     * Set languages
     *
     * @return void
     */
    private function setLanguages()
    {
        $language = [];

        try {
            $language = $this->getArguments();
        } catch(\InvalidArgumentException $e) {
            echo $e->getMessage();
            //exit;
        }
        
        if (is_array($language)) {
            $this->languages = $language;
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
     * Translate input materials
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


    /**
     * Get arguments from command line
     *
     * @return array
     */
    public function getArguments()
    {
        $language = [];        
        $arguments = $_SERVER['argv'];

        if (isset($arguments[1])) {
            array_shift($arguments);
            foreach ($arguments as $argument) {
                $language[] = strtolower(trim($argument));
            }
        } else {
            throw new \InvalidArgumentException("\nUSAGE: php index.php <arguments [ex.: en, uk, de etc.]>\n" . PHP_EOL);
        }

        return $language;
    }
}