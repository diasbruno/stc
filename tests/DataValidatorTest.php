<?php

namespace STC\Test;

use STC\Config;
use STC\DataValidator;

class DataValidatorTest extends \PHPUnit_Framework_TestCase
{
  private $validator;

  public function setup()
  {
    $this->validator = new DataValidator();
  }

  public function testValidatorEmpty()
  {
    $data = array();
    $this->assertTrue($this->validator->validate($data));
  }

  public function testSimpleKeyValidator()
  {
    $data = array('key' => '');
    $this->validator->required('key');
    $this->assertTrue($this->validator->validate($data));
  }

  public function testSimpleKeyValidatorFail()
  {
    $data = array('' => '');
    $this->validator->required('key');
    $this->assertFalse($this->validator->validate($data));
  }

  public function testComposedKeyValidator()
  {
    $data = array('key' => array('innerkey' => ''));
    $this->validator->required('key.innerkey');
    $this->assertTrue($this->validator->validate($data));
  }

  public function testComposedKeyValidatorFail()
  {
    $data = array('key' => array('innerkey' => ''));
    $this->validator->required('key.innerkey.error');
    $this->assertFalse($this->validator->validate($data));
  }

  public function testComposedKeyValidatorBigData()
  {
    $data = array(
      'key' => array(
        'innerkey' => array(
          'inner_inner_key' => ''
        )
      )
    );
    $this->validator->required('key.innerkey');
    $this->assertTrue($this->validator->validate($data));
  }
}
