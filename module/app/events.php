<?php //-->
/**
 * This file is part of a Custom Project.
 */

/**
 * Render blank page
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('render-blank', function($req, $res) {
  $this('app')->render($req, $res, 'blank');
});

/**
 * Render app page
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('event')->on('render-app', function($req, $res) {
  $this('app')->render($req, $res, 'app');
});
