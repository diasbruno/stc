<?php 

namespace STC\Test;

use STC\Config;
use STC\Database;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

  public function testCreateTheInstance()
  {
    $this->assertTrue(Config::db() instanceof Database);
  }

  public function testTryingToStoreDataWithoutAKey()
  {
    try {
      Config::db()->store('', []);
    } catch(\Exception $e) {
      $this->assertTrue(true);
    }
  }

  public function testStoreAndRetrieveData_ItWillBeLockedByDefault()
  {
    $data = [ 'dummy' => 'dummy' ];
    Config::db()->store('some-data', $data);
    $this->assertTrue(Config::db()->retrieve('some-data') == $data);
  }

  public function testTryingToStoreDataWithExistingKeyThatIsLocked()
  {
    $data = [ 'dummy' => 'dummy' ];
    try {
      Config::db()->store('some-data', []);
    } catch(\Exception $e) {
      $this->assertTrue(Config::db()->retrieve('some-data') == $data);
    }
  }

  public function testStoreUnlockedData()
  {
    $data = [ 'dummy' => 'dummy' ];
    Config::db()->store('some-data-2', [], false);
    Config::db()->store('some-data-2', $data);
    $this->assertTrue(Config::db()->retrieve('some-data-2') == $data);
  }
}
