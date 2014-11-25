<?php 

namespace STC\Test;

use STC\Application;
use STC\Database;

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

  public function testCreateTheInstance()
  {
    $this->assertTrue(Application::db() instanceof Database);
  }

  public function testTryingToStoreDataWithoutAKey()
  {
    try {
      Application::db()->store('', array());
    } catch(\Exception $e) {
      $this->assertTrue(true);
    }
  }

  public function testStoreAndRetrieveData_ItWillBeLockedByDefault()
  {
    $data = array( 'dummy' => 'dummy' );
    Application::db()->store('some-data', $data);
    $this->assertTrue(Application::db()->retrieve('some-data') == $data);
  }

  public function testTryingToStoreDataWithExistingKeyThatIsLocked()
  {
    $data = array( 'dummy' => 'dummy' );
    try {
      Application::db()->store('some-data', array());
    } catch(\Exception $e) {
      $this->assertTrue(Application::db()->retrieve('some-data') == $data);
    }
  }

  public function testStoreUnlockedData()
  {
    $data = array( 'dummy' => 'dummy' );
    Application::db()->store('some-data-2', array(), false);
    Application::db()->store('some-data-2', $data);
    $this->assertTrue(Application::db()->retrieve('some-data-2') == $data);
  }
}
