<?php //-->

return function() {
  //set config folder
  $this('config')->setFolder(INCEPT_CWD . '/config');

  $this('system')
    //set schema folder
    ->setSchemaFolder(INCEPT_CWD . '/config/schema')
    //set fieldset folder
    ->setFieldsetFolder(INCEPT_CWD . '/config/fieldset');
};
