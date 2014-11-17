<?php
// Test runner.
$current_dir = dirname(__FILE__);
require $current_dir . '/vendor/autoload.php';


$test_dir = $current_dir . '/tests';
$files = array_diff(scandir($test_dir), array('..', '.'));

// TODO: use a regular expression to filter valid tests files.
foreach($files as $test) {
  if ($test[0] != '.') {
    require ($test_dir . '/' . $test);
  }
}
