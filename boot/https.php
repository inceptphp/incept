<?php //-->

return function ($req) {
  $https = $this('config')->get('settings', 'https');
  $req->setHost($https ? 'https': 'http');
};
