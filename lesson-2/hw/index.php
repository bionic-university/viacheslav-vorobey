<?php

require_once('src/PalindromesDetector.php');

$palindrome = new PalindromesDetector($argv[1]);

$res = ($palindrome->findPalindrome() === true) ? "\nOk, It's a palindrom \n" : "\nFail, It's not a palindrome \n";

echo $res;
