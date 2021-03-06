<?php //-->

return function() {
  //set config folder
  $this('config')->setFolder(INCEPT_CWD . '/config');

  $this('system')
    //set schema folder
    ->setSchemaFolder(INCEPT_CWD . '/config/schema')
    //set fieldset folder
    ->setFieldsetFolder(INCEPT_CWD . '/config/fieldset');

  $this('file')
    //set upload folder
    ->setUploadFolder(INCEPT_CWD . '/public/upload')
    //set URI path
    ->setUriPath('/upload');
};
