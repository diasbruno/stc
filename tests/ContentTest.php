<?php

namespace STC\Test;

use STC\Application;

class ContentTest extends \PHPUnit_Framework_TestCase
{
  public function setup() {}

  public function testLoadContentFiles()
  {
    $this->assertTrue(Application::files()->count() > 0);
  }
}
