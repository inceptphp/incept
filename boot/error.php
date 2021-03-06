<?php //-->

return function() {
  $config = $this('config')->get('settings');

  if (!isset($config['debug_mode'])) {
    $config['debug_mode'] = 0;
  }

  $mode = $config['debug_mode'];

  //this happens on an error
  $this->error(function ($request, $response, $error) use ($mode) {
    //if this error has already been handled
    if ($response->hasContent()) {
      return;
    }

    //prevent nice errors in cli mode
    if (php_sapi_name() === 'cli') {
      throw $error;
      return false;
    }

    $detail = !!$mode;
    $type = $response->getHeaders('Content-Type');

    if (!$type) {
      $type = 'text/plain';
      $response->setHeaders('Content-Type', $type);
    }

    switch (true) {
      case strpos($type, 'html') !== false:
        //if its a 404
        if ($response->getCode() === 404) {
          //no need to spazz out..
          $body = $body = '<h1>404 Not Found</h1>';
          break;
        }

        $message = 'A Server Error occurred';

        if (!$detail) {
          $body = '<h1>' . $message . '</h1>';
          break;
        }

        $exception = get_class($error);
        $message = $error->getMessage();
        $line = $error->getLine();
        $file = $error->getFile();
        $trace = $error->getTraceAsString();

        $body = sprintf(
          '<h1>%s thrown: %s</h1><br />%s(%s)<br /><br />%s',
          $exception,
          $message,
          $file,
          $line,
          nl2br($trace)
        );

        break;
      case strpos($type, 'json') !== false:
        //if its a 404
        if ($response->getCode() === 404) {
          //no need to spazz out..
          $body = json_encode(
            [
              'error' => true,
              'message' => 'Resource not found.'
            ],
            JSON_PRETTY_PRINT
          );

          break;
        }

        $message = 'A Server Error occurred.';

        if (!$detail) {
          $body = json_encode(
            [
              'error' => true,
              'message' => $message
            ],
            JSON_PRETTY_PRINT
          );

          break;
        }

        $exception = get_class($error);
        $message = $error->getMessage();
        $line = $error->getLine();
        $file = $error->getFile();
        $trace = $error->getTraceAsString();

        $body = json_encode(
          [
            'error'   => true,
            'message'   => $exception . 'thrown: ' . $message,
            'file'    => $file . '(' . $line . ')',
            'trace'   => explode("\n", $trace)
          ],
          JSON_PRETTY_PRINT
        );

        break;
      default:
        $message = 'A Server Error occurred';

        if (!$detail) {
          $body = $message;
          break;
        }

        $exception = get_class($error);
        $message = $error->getMessage();
        $line = $error->getLine();
        $file = $error->getFile();
        $trace = $error->getTraceAsString();

        $body = sprintf(
          "%s thrown: %s\n%s(%s)\n\n%s",
          $exception,
          $message,
          $file,
          $line,
          $trace
        );

        break;
    }

    $response->setContent($body);
  });
};
