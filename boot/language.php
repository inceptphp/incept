<?php //-->

return function() {

  $translations = [];
  //get the default language
  $language = $this('config')->get('settings', 'language');
  //make the file
  $file = sprintf('%s/config/language/%s.php', INCEPT_CWD, $language);
  //if the file exists
  if (file_exists($file)) {
    //load the translations
    $translations = include $file;
  }
  //set the language
  $this('lang')->setLanguage($translations);
};
