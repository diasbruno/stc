<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Testify\Testify;
use STC\Config;

// after we run the bootstrap,
// all data must be already available.
$test_case = new Testify('test project contents.');

$test_case->test('load content files.', function($t)
{
  $t->assert(Config::files()->count() > 0);
});

$test_case();
