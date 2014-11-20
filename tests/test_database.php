<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Testify\Testify;
use STC\Config;
use STC\Database;

// after we run the bootstrap,
// all data must be already available.
$test_case = new Testify('test in-memory database.');

$test_case->test('create the instance.', function($t)
{
  $t->assert(Config::db() instanceof Database);
});

$test_case->test('trying to store data without a key.', function($t)
{
  try {
    Config::db()->store('', []);
  } catch(\Exception $e) {
    $t->assert(true);
  }
});

$test_case->test('store and retrive data. it will be locked by default.', function($t)
{
  $data = [ 'dummy' => 'dummy' ];
  Config::db()->store('some-data', $data);
  $t->assert(Config::db()->retrive('some-data') == $data);
});

$test_case->test('trying to store data with existing key that is locked.', function($t)
{
  $data = [ 'dummy' => 'dummy' ];
  try {
    Config::db()->store('some-data', []);
  } catch(\Exception $e) {
    $t->assert(Config::db()->retrive('some-data') == $data);
  }
});

$test_case->test('store unlocked data.', function($t)
{
  $data = [ 'dummy' => 'dummy' ];
  Config::db()->store('some-data-2', [], false);
  Config::db()->store('some-data-2', $data);
  $t->assert(Config::db()->retrive('some-data-2') == $data);
});

$test_case();
