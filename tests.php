<?php
// Test runner.
$current_dir = dirname(__FILE__);
require $current_dir . '/vendor/autoload.php';


$test_dir = $current_dir . '/tests';
$files = array_diff(scandir($test_dir), array('..', '.'));

foreach($files as $test) {
  $test = require ($test_dir . '/' . $test);
	$test();
}
