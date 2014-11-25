<?php 

namespace STC\Test;

use STC\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
  public function setup() {}

	public function testDefaultApplicationWithoutAValidDataFolder()
	{
	  try {
	    Application::bootstrap();
	  } catch(\Exception $e) {
	    $this->assertTrue(true);
	  }
	}

	public function testDefaultApplication()
	{
	  $this->assertTrue(Application::bootstrap(dirname(__FILE__), 'data'));
	}

	public function testloadSiteApplication()
	{
	  $this->assertTrue(Application::config()->name() == 'simple web project');
	  $this->assertTrue(Application::config()->public_folder() == 'web');
	  $this->assertTrue(Application::config()->get("my_data") == 'stuff');
	}
}
