<?php
// Test runner.
$current_dir = dirname(__FILE__);
require $current_dir . '/vendor/autoload.php';

$test_dir = $current_dir . '/tests';
$files = array_diff(scandir($test_dir), array('..', '.'));

$test_pattern = '/^test_\w+.php$/';

// TODO: use a regular expression to filter valid tests files.
foreach($files as $test) {
  if (preg_match($test_pattern, $test)) {
    require $test_dir . '/' . $test;
  }
}
