<?php //-->

return function() {
  // load package config
  $packages = [];

  if (file_exists(INCEPT_CWD . '/config/packages.php')) {
    $packages = include INCEPT_CWD . '/config/packages.php';
  } else if (file_exists(INCEPT_CWD . '/config/packages.sample.php')) {
    $packages = include INCEPT_CWD . '/config/packages.sample.php';
  }

  //still nothing?
  if (!is_array($packages)) {
    return $this;
  }

  // on each packages
  foreach ($packages as $name => $package) {
    // skip if no name or not active
    if (!isset($package['active']) || $package['active'] === false) {
      continue;
    }

    // register the package
    $this->register($name);
  }

  return $this;
};
