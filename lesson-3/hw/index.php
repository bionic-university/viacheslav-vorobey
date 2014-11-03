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


// @TODO: Move to Translator class
// Clear the input arguments
$language = [];
if (count($argv) > 1) {
	array_shift($argv);
	foreach ($argv as $argument) {
		$language[] = $argument;
	}
}


// Instantiate a translator
$translator = new Translator($language);

$movie = new Movie('de');
try {    
    $translator->translate(new Book('fr'));
    $translator->translate(new Magazine('es'));
    $translator->translate(new Audiobook);
    $translator->translate($movie);
} catch(Exception $e) {
    echo $e->getMessage() . PHP_EOL;
}