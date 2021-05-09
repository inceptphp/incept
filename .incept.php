<?php //-->
require_once 'vendor/autoload.php';

//denote the CWD
if (!defined('INCEPT_CWD')) {
  define('INCEPT_CWD', __DIR__);
}

//use the incept function
Incept\Framework\Decorator::DECORATE;

/**
 * This is where you would add CLI related tools
 */
incept()
  ->setCwd(INCEPT_CWD)

  ->preprocess(include INCEPT_CWD . '/boot/paths.php')
  ->preprocess(include INCEPT_CWD . '/boot/error.php')

  ->preprocess(include INCEPT_CWD . '/boot/timezone.php')
  ->preprocess(include INCEPT_CWD . '/boot/language.php')

  ->preprocess(include INCEPT_CWD . '/boot/session.php')
  ->preprocess(include INCEPT_CWD . '/boot/https.php')

  ->call(include INCEPT_CWD . '/boot/packages.php')
;
