<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Database
{
  /**
   * Storage.
   * @var array
   */
  private $db;

  /**
   * @constructor
   */
  public function __construct()
  {
    $this->db = array();
  }

  /**
   * Create a new slot for a key.
   * @param $key string | The key name.
   * @param $lock bool | Data should be locked?
   * @return void
   */
  private function create($key, $lock = true)
  {
    $this->db[$key] = array('locked' => $lock, 'content' => null);
  }

  /**
   * Store data for a key.
   * @param $key string | The key name.
   * @param $value array | The data.
   * @return void
   */
  private function store_data($key, $value = array())
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
   * Key already exists?
   * @param $key string | The key name.
   * @return bool
   */
  public function has_key($key)
  {
    return array_key_exists($key, $this->db);
  }

  /**
   * Data for a key is locked?
   * @param $key string | The key name.
   * @return bool
   */
  private function is_locked($key)
  {
    return $this->db[$key]['locked'];
  }

  /**
   * Saves some data by key value.
   * @param $key string | The key name.
   * @param $value any | The value.
   */
  public function store($key = '', $value = array(), $lock = true)
  {
    if ($key == '') {
      $this->fault('[Error] Cannot store data without a key. Key is "' . $key . '".');
    }

    if (!$this->has_key($key)) {
      $this->create($key, $lock);
      $this->store_data($key, $value);
    } else {
      if (!$this->is_locked($key)) {
        $this->store_data($key, $value);
      } else {
        $this->fault('[Error] Cannot store data with a registered key that is locked.');
      }
    }
  }

  /**
   * Retrieves data by key.
   * @param $key string | The key name.
   * @return any
   */
  public function retrieve($key)
  {
    if (array_key_exists($key, $this->db)) {
      return $this->db[$key]['content'];
    }

    return array();
  }

  /**
   * Dump the current database.
   * @return void
   */
  public function dump()
  {
    var_dump($this->db);
  }
}
