<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Testify\Testify;
use STC\Config;

// after we run the bootstrap,
// all data must be already available.
$test_case = new Testify('test templates.');

$test_case->test('load templates from the folder.', function($t)
{
  $t->assertTrue(Config::templates()->count() > 0);
});

$test_case->test('get default template.', function($t)
{
  $t->assertTrue(Config::templates()->template('default') != '');
});

$test_case();
