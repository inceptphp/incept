<?php //-->

return function($req, $res) {
  //prevent starting session in cli mode
  if (php_sapi_name() === 'cli') {
    return;
  }

  //start session
  session_start();

  //sync the session
  $req->setSession($_SESSION);
  $res->setSession($_SESSION);

  //set the language
  if (!$req->hasSession('i18n')) {
    $res->setSession('i18n', 'en_US');
    $settings = $this('config')->get('settings');
    if (isset($settings['i18n'])) {
      $res->setSession('i18n', $settings['i18n']);
    }
  }
};
