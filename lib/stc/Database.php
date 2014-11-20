<?php

namespace STC;

class Database
{
  private $db;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->db = [];
  }

  /**
   * Create a new slot for a key.
   * @param $key string | The key name.
   * @param $lock bool | Data should be locked?
   * @return void
   */
  private function create($key, $lock = true)
  {
    $this->db[$key] = ['locked' => $lock, 'content' => null];
  }

  /**
   * Store data for a key.
   * @param $key string | The key name.
   * @param $value array | The data.
   * @return void
   */
  private function store_data($key, $value = [])
  {
    $this->db[$key]['content'] = $value;
  }

  /**
   * Throws exception.
   * @param $str string | The error string.
   */
  private function fault($str = '')
  {
    throw new \Exception($str);
  }

  /**
   * Saves some data by key value.
   * @param $key string | The key name.
   * @param $value any | The value.
   */
  public function store($key = '', $value = [], $lock = true)
  {
    if ($key == '') {
      $this->fault('[Error] Cannot store data without a key. Key is ' . $key);
    }

    if (!array_key_exists($key, $this->db)) {
      $this->create($key, $lock);
      $this->store_data($key, $value);
    } else {
      if (!$this->db[$key]['locked']) {
        $this->store_data($key, $value);
      } else {
        $this->fault('[Error] Cannot store data with a registered key that is locked.');
      }
    }
  }

  /**
   * Retrives data by key.
   * @param $key string | The key name.
   * @return any
   */
  public function retrive($key)
  {
    if (array_key_exists($key, $this->db)) {
      return $this->db[$key]['content'];
    }

    return [];
  }
}
