<?php

namespace STC\Test;

use STC\Config;

class TemplatesTest extends \PHPUnit_Framework_TestCase
{
  public function setup()
  {
  }

  public function testLoadTemplatesFromTheFolder()
  {
    $this->assertTrue(Config::templates()->count() > 0);
  }

  public function testGetDefaultTemplate()
  {
    $this->assertTrue(Config::templates()->template('default') != '');
  }
}
