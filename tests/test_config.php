<?php 

require_once dirname(__FILE__) . '/../vendor/autoload.php';

use Testify\Testify;
use STC\Config;

$test_case = new Testify('test');

$test_case->test('default config without a valid data folder.', function($t)
{
  try {
    Config::bootstrap();
  } catch(\Exception $e) {
    $t->assertTrue(true);
  }
});

$test_case->test('default config.', function($t)
{
  $t->assertTrue(Config::bootstrap(dirname(__FILE__), 'data'));
});

$test_case->test('load site config.', function($t)
{
  $t->assert(Config::site()->name() == 'simple web project');
  $t->assert(Config::site()->public_folder() == 'web');
  $t->assert(Config::site()->get("my_data") == 'stuff');
});

$test_case->test('load data.', function($t)
{
  // after we run the bootstrap, 
  // all data must be already available.
  $t->assert(count(Config::files()) > 0);
});

$test_case();
