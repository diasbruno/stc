<?php

namespace STC;

class Data
{
  protected $data;

  public function __construct() {}

  /**
   * Use this method to ensure that the key must be present.
   * @param $key string | The key name.
   * @return object
   */
  public function get($key)
  {
    return $this->data[$key];
  }

  /**
   * Use this method for optional values.
   * @param $key string | The key name.
   * @return object
   */
  public function getOptional($key, $defaultValue = null)
  {
    if (array_key_exists($key, $this->data)) {
      return $this->data[$key];
    }
    return $defaultValue;
  }
}
