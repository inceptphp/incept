<?php //-->
/**
 * This file is part of a Custom Project.
 */

require_once __DIR__ . '/AppPackage.php';
require_once __DIR__ . '/controller/assets.php';

require_once __DIR__ . '/events.php';
require_once __DIR__ . '/package.php';

use Incept\Module\App\AppPackage;

$this
  //then load the package
  ->package('/module/app')
  //map the package with the event package class methods
  ->mapPackageMethods($this('resolver')->resolve(AppPackage::class, $this));

$this
  //Register a pseudo package admin
  ->register('app')
  //then load the package
  ->package('app')
  //map the package with the event package class methods
  ->mapPackageMethods($this('resolver')->resolve(AppPackage::class, $this));

//set an error handler
$this->error([$this('app'), 'error']);
