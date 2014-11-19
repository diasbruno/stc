<?php

namespace STC;

class Database
{
  private $db;

  public function __construct()
  {
    $this->db = [];
  }

  /**
   * Saves some data by key value.
   * @param $key string | The key name.
   * @param $value any | The value.
   */
  public function store_data($key, $value)
  {
    $this->db[$key] = $value;
  }

  /**
   * Retrives data by key.
   * @param $key string | The key name.
   * @return any
   */
  public function retrive_data($key)
  {
    if (array_key_exists($key, $this->db)) {
      return $this->db[$key];
    }

    return [];
  }
}
