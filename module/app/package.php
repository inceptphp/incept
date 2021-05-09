<?php //-->
/**
 * This file is part of a package designed for the Incept Project.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

use UGComponents\IO\Request\RequestInterface;
use UGComponents\IO\Response\ResponseInterface;

/**
 * $ incept /module/app ...
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('/module/app', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $event = 'help';

  if($request->hasStage(0)) {
    $event = $request->getStage(0);
    $request->removeStage(0);
  }

  if($request->hasStage()) {
    $data = [];
    $stage = $request->getStage();
    foreach($stage as $key => $value) {
      if(!is_numeric($key)) {
        $data[$key] = $value;
      } else {
        $data[$key - 1] = $value;
      }

      $request->removeStage($key);
    }

    $request->setStage($data);
  }

  $name = '/module/app';
  $event = sprintf('%s-%s', $name, $event);

  $this('event')->emit($event, $request, $response);
});

/**
 * $ incept /module/app help
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('/module/app-help', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $this('terminal')
    ->warning('Admin Commands:')

    ->output(PHP_EOL)

    ->success('incept /module/app install')
    ->info(' Installs this package')

    ->output(PHP_EOL)

    ->success('incept /module/app update')
    ->info(' Updates this package')

    ->output(PHP_EOL)

    ->success('incept /module/app uninstall')
    ->info(' Removes this package')

    ->output(PHP_EOL);
});

/**
 * $ incept /module/app install
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('/module/app-install', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $request->setStage('name', '/module/app');
  //just do the default installer
  $this('event')->emit('inceptphp/packages-install', $request, $response);
});

/**
 * $ incept /module/app update
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('/module/app-update', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $request->setStage('name', '/module/app');
  //just do the default installer
  $this('event')->emit('inceptphp/packages-update', $request, $response);
});

/**
 * $ incept /module/app uninstall
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('/module/app-uninstall', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $request->setStage('name', '/module/app');
  //just do the default installer
  $this('event')->emit('inceptphp/packages-uninstall', $request, $response);
});
