<?php //-->

return function() {
  //set the server timezone
  $timezone = $this('config')->get('settings', 'timezone');
  //if no timezone set
  if (!$timezone) {
    //this could happen if project isn't installed yet
    return;
  }
  $this('tz')->setTimezone($timezone);
};
