<?php

namespace STC\Test;

use STC\Config;

class ContentTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

  public function testLoadContentFiles()
  {
    $this->assertTrue(Config::files()->count() > 0);
  }
}
