<?php

namespace STC;

class DataValidator
{
  private $list;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->list = array();
  }

  /**
   * Add a new key string to check.
   * @param $key string | the key to check.
   * @return void
   */
  public function set($key)
  {
    $this->list[] = $key;
  }

  /**
   * Recursive walker to check.
   * @param $keys array | List of keys.
   * @param $arr array | A hash list to check.
   * @return bool
   */
  private function walker($keys, &$arr)
  {
    if (count($keys) == 0) {
      return true;
    }

    $current = array_shift($keys);

    return (is_array($arr) ? array_key_exists($current, $arr) : false)
        && ((is_array($arr[$current])) ?
          $this->walker($keys, $arr[$current]) : 
          (count($keys) > 0 ? false : true));
  }

  /**
   * Tries to validate a hash list.
   * @param $arr array | The array to check.
   * @return bool
   */
  public function validate(&$arr)
  {
    if (count($this->list) == 0) {
      return true;
    }

    $ok = true;  

    foreach ($this->list as $key => $value) {
      $list = explode('.', $value);
      $ok = $ok && $this->walker($list, $arr);
    }

    return $ok;
  }
}
