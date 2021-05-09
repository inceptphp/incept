<?php //-->

return [
  'sql-build' => [
    'type' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'user' => 'root',
    'pass' => '',
    'active' => true
  ],
  'sql-main' => [
    'type' => 'mysql',
    'host' => '127.0.0.1',
    'port' => 3306,
    'name' => 'incept',
    'user' => 'root',
    'pass' => '',
    'active' => true
  ],
  'amq-main' => [
    'host' => '127.0.0.1',
    'port' => 5672,
    'name' => 'queue',
    'user' => 'guest',
    'pass' => 'guest',
    'active' => false
  ],
  'email-main' => [
    'host' => 'smtp.gmail.com',
    'port' => '587',
    'type' => 'tls',
    'name' => 'Incept',
    'user' => '<EMAIL ADDRESS>',
    'pass' => '<EMAIL PASSWORD>',
    'active' => false
  ],
  'captcha-main' => [
    'host' => 'https://www.google.com/recaptcha/api/siteverify',
    'token' => '<GOOGLE CAPTCHA TOKEN>',
    'secret' => '<GOOGLE CAPTCHA SECRET>',
    'active' => false
  ],
];
