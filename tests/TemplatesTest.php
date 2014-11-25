<?php

namespace STC\Test;

use STC\Application;

class TemplatesTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

  public function testLoadTemplatesFromTheFolder()
  {
    $this->assertTrue(Application::templates()->count() > 0);
  }

  public function testGetDefaultTemplate()
  {
    $this->assertTrue(Application::templates()->template('default') != '');
  }
}
