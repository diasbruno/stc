<?php 

namespace STC\Test;

use STC\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

	public function testDefaultConfigWithoutAValidDataFolder()
	{
	  try {
	    Config::bootstrap();
	  } catch(\Exception $e) {
	    $this->assertTrue(true);
	  }
	}

	public function testDefaultConfig()
	{
	  $this->assertTrue(Config::bootstrap(dirname(__FILE__), 'data'));
	}

	public function testloadSiteConfig()
	{
	  $this->assertTrue(Config::site()->name() == 'simple web project');
	  $this->assertTrue(Config::site()->public_folder() == 'web');
	  $this->assertTrue(Config::site()->get("my_data") == 'stuff');
	}
}
