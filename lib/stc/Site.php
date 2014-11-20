<?php

namespace STC;

/**
 * @author Bruno Dias <dias.h.bruno@gmail.com>
 * @license MIT License (see LICENSE)
 */
class Site
{
  /**
   * @constructor
   */
  public function __construct() {}

  /**
   * Load files from a given directory.
   * @param $data_folder string | The folder name.
   * @return array
   */
  public function load($data_folder = '')
  {
    $data_loader = new DataLoader();
    $this->data = $data_loader->load(
      $data_folder,
      '/config.json'
    );
  }

  /**
   * Returns the name of the project.
   * @return string
   */
  public function name()
  {
    return $this->data['name'];
  }

  /**
   * Returns the name of the public folder
   * where all the files will be exported.
   * @return string
   */
  public function public_folder()
  {
    return $this->data['public_folder'];
  }

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
