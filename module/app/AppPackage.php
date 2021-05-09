<?php //-->
/**
 * This file is part of a Custom Project.
 */

namespace Incept\Module\App;

use Incept\Package\Admin\AdminPackage;

use UGComponents\IO\Request\RequestInterface;
use UGComponents\IO\Response\ResponseInterface;

use Throwable;
use ReflectionFunction;

/**
 * Admin Package
 *
 * @vendor   Incept
 * @package  Package
 * @standard PSR-2
 */
class AppPackage extends AdminPackage
{
  /**
   * Error Processor
   *
   * @param *RequestInterface  $request
   * @param *ResponseInterface $response
   * @param *Throwable          $error
   *
   * @return mixed
   */
  public function error(
    RequestInterface $request,
    ResponseInterface $response,
    Throwable $error
  ) {
    //prevent starting session in cli mode
    if (php_sapi_name() === 'cli') {
      return;
    }

    //get the path
    $path = $request->getPath('string');
    //if it was a call for an actual file
    if (preg_match('/\.[a-zA-Z0-9]{1,4}$/', $path)) {
      return;
    }

    //if this is not an html page
    $type = $response->getHeaders('Content-Type');
    if (strpos($type, 'html') === false) {
      //don't make it pretty
      return $this->errorDebug($request, $response, $error);
    }

    //get the code
    $code = $response->getCode();

    if ($code === 404) {
      return $this->error404($request, $response, $error);
    }

    //get config settings
    $settings = $this->handler->package('config')->get('settings');

    //if no environment
    if (!isset($settings['environment'])
      //or the environment is not live
      || $settings['environment'] !== 'live'
      //or it's not a 500 error
      || $code !== 500
    ) {
      //don't make it pretty
      return $this->errorDebug($request, $response, $error);
    }

    //okay make it pretty...
    $this->error500($request, $response, $error);

    if (!isset($settings['email'])) {
      return true;
    }

    return $this->errorEmail($request, $response, $error);
  }

  /**
   * Render admin page and store it in the response
   *
   * @param *RequestInterface  $request
   * @param *ResponseInterface $response
   * @param string             $layout
   *
   * @return string
   */
  public function render(
    RequestInterface $request,
    ResponseInterface $response,
    string $layout = 'app'
  ): string {
    //load some packages
    $host = $this->handler->package('host');
    $handlebars = $this->handler->package('handlebars');

    //deal with flash messages
    if ($response->hasSession('flash')) {
      $flash = $response->getSession('flash');
      $response->set('page', 'flash', $flash);
      $response->removeSession('flash');
    }

    $data = [
      'page' => $response->get('page'),
      'results' => $response->getResults(),
      'content' => $response->getContent(),
      'i18n' => $request->getSession('i18n'),
      'host' => $host->all()
    ];

    $template = __DIR__ . '/template';

    $page = $handlebars
      ->registerPartialFromFile('head', $template . '/_head.html')
      ->registerPartialFromFile('left', $template . '/_foot.html')
      ->registerPartialFromFile('flash', $template . '/_flash.html')
      ->renderFromFile(sprintf('%s/_%s.html', $template, $layout), $data);

    $response->setContent($page);
    return $page;
  }
}
