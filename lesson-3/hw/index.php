<?php

// Class autoloader
spl_autoload_register(function ($className) {
	$filePath = 'src' . DIRECTORY_SEPARATOR . $className . '.php';
	if (file_exists($filePath)) {
		require_once $filePath;
	} else {
		require_once 'src' . DIRECTORY_SEPARATOR . 'Material' . DIRECTORY_SEPARATOR . $className . '.php';
	}

	if (file_exists('vendor/autoload.php')) {
		require_once 'vendor/autoload.php';
	}
});


// Instantiate a translator
$translator = new Translator();

try {    
    $translator->translate(new Book('fr'));
    $translator->translate(new Magazine());
    $translator->translate(new Audiobook);
    $translator->translate(new Movie('de'));
} catch(\Exception $e) {
    echo $e->getMessage() . PHP_EOL; // why this shit doesn't work?
}