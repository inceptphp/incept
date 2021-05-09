<?php //-->

use UGComponents\IO\Request\RequestInterface;
use UGComponents\IO\Response\ResponseInterface;

/**
 * Render the JSON files we have
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('http')->get('/json/:name.json', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $name = $request->getStage('name');
  $file = sprintf('%s/assets/json/%s.json', dirname(__DIR__), $name);

  if (!file_exists($file)) {
    return;
  }

  $response->addHeader('Content-Type', 'text/json');
  $response->setContent(file_get_contents($file));
});

/**
 * Render Admin JS
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('http')->get('/scripts/app.js', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $body = $this('handlebars')
    ->setTemplateFolder(dirname(__DIR__) . '/assets')
    ->registerPartialFromFolder('script_fields', 'js')
    ->registerPartialFromFolder('script_form', 'js')
    ->registerPartialFromFolder('script_misc', 'js')
    ->registerPartialFromFolder('script_jquery', 'js')
    ->renderFromFolder('script', [], 'js');

  $response->addHeader('Content-Type', 'text/javascript');
  $response->setContent($body);
});

/**
 * Render Admin CSS
 *
 * @param RequestInterface $request
 * @param ResponseInterface $response
 */
$this('http')->get('/styles/app.css', function (
  RequestInterface $request,
  ResponseInterface $response
) {
  $body = $this('handlebars')
    ->setTemplateFolder(dirname(__DIR__) . '/assets')
    ->registerPartialFromFolder('style_components', 'css')
    ->registerPartialFromFolder('style_error', 'css')
    ->registerPartialFromFolder('style_fields', 'css')
    ->registerPartialFromFolder('style_layout', 'css')
    ->registerPartialFromFolder('style_reset', 'css')
    ->registerPartialFromFolder('style_theme', 'css')
    ->registerPartialFromFolder('style_twbs', 'css')
    ->renderFromFolder('style', [], 'css');

  $response->addHeader('Content-Type', 'text/css');
  $response->setContent($body);
});
